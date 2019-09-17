<?php

namespace App\Http\Controllers\Api\v1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\TranslationManager\Models\Translation;
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

    public function fetchTranslations(Request $request)
    {
        $allTranslations = Translation::where('group', $request->group)
                                ->where('locale', $request->locale)
                                ->orderBy('key', 'asc')->get();

        return response()->json([
            'translations' => $allTranslations
        ], 200);
    }

    public function update(Request $request)
    {
        dd($request);

        $group = $request->group;
        $locale = $request->locale;

        if(!in_array($group, $this->manager->getConfig('exclude_groups'))) {
            $name = request()->get('name');
            $value = request()->get('value');
            list($locale, $key) = explode('|', $name, 2);
            $translation = Translation::firstOrNew([
                'locale' => $locale,
                'group' => $group,
                'key' => $key,
            ]);
            $translation->value = (string) $value ?: null;
            $translation->status = Translation::STATUS_CHANGED;
            $translation->save();
            return array('status' => 'ok');
        }
    }

}
