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

}
