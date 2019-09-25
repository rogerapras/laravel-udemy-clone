<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\TranslationManager\Models\Translation;
use App\Models\Language;
use Illuminate\Support\Collection;
use Barryvdh\TranslationManager\Manager;
use Tanmuhittin\LaravelGoogleTranslate\Commands\TranslateFilesCommand;

class AdminLocaleController extends Controller
{
    
    protected $manager;

    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    public function fetchAllLanguages(Request $request)
    {
        $query = (new Language)->newQuery()->orderBy('is_default', 'desc')->orderBy('is_active', 'desc')->orderBy('name'); 
        if($request->activeOnly){
            $query->where('is_active', true)->get();
        }
        return response()->json($query->get(), 200);
    }

    public function updateLanguage(Request $request, $id)
    {
        $language = Language::find($id);
        $this->validate($request, [
            'name' => 'required|unique:languages,name,'.$language->id,
            'carbon_code' => 'required|unique:languages,carbon_code,'.$language->id,
            'php_code' => 'required|unique:languages,php_code,'.$language->id
        ]);
        
        if($request->is_default == true){
            Language::where('is_default', true)->update([
                'is_default' => false
            ]);
        }
        $language->update([
            'name' => $request->name,
            'php_code' => $request->php_code,
            'carbon_code' => $request->carbon_code,
            'is_active' => $request->is_active,
            'is_default' => $request->is_default,
            'is_rtl' => $request->is_rtl
        ]);

        \Cache::forget('locales');

    }

    public function fetchTranslations(Request $request)
    {

        $allTranslations = Translation::where('group', $request->group)
                                ->where('locale', $request->locale)
                                ->orderBy('key', 'asc')->get();
        
        $distinctKeys= Translation::where('group', $request->group)->distinct()->pluck('key');
        $transKeys = $allTranslations->pluck('key');
        $diff = \Arr::flatten($distinctKeys->diff($transKeys)->all());
        

        $groups = Translation::groupBy('group');
        $excludedGroups = $this->manager->getConfig('exclude_groups');
        if($excludedGroups){
            $groups->whereNotIn('group', $excludedGroups);
        }
        $groups = $groups->select('group')->orderBy('group')->get()->pluck('group', 'group');
        if ($groups instanceof Collection) {
            $groups = $groups->all();
        }

        return response()->json([
            'difference' => $diff,
            'translations' => $allTranslations,
            'groups' => $groups
        ], 200);
    }

    public function updateTranslation(Request $request, $id)
    {
   
        $group = $request->group;
        if(!in_array($group, $this->manager->getConfig('exclude_groups'))) {
            $value = request()->get('value');
            $translation = Translation::find($id);
            $translation->value = (string) $value ?: null;
            $translation->status = Translation::STATUS_CHANGED;
            $translation->save();
            return response()->json(null, 200);
        }
    }

    public function getDefaultValue(Request $request)
    {
        $key = $request->key;
        $default = Translation::where('locale', 'en')->where('key', $key)->first();
        return response()->json($default, 200);

    }

    public function saveTranslation(Request $request)
    {
        $group = $request->group;
        $locale = $request->locale;
        $key = $request->key;
        $value = $request->value;
        if(!in_array($group, $this->manager->getConfig('exclude_groups'))) {
            $translation = new Translation();
            $translation->key = $key;
            $translation->value = $value;
            $translation->locale = $locale;
            $translation->group = $group;
            $translation->status = Translation::STATUS_SAVED;
            $translation->save();
            return response()->json(null, 200);
        }
    }

    public function publish($group)
    {
        $json = false;
        if($group === '_json'){
            $json = true;
        }
        $this->manager->exportTranslations($group, $json);
        return response()->json(null, 200);
    }

}
