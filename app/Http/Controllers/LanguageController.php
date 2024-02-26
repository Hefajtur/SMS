<?php

namespace App\Http\Controllers;

use App\Http\Requests\language\LanguageRequest;
use App\Models\language\Country;
use App\Models\Language;
use App\Services\language\LanguageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    protected $data;

    // Language Index
    public function langIndex(Request $request)
    {

        if (request()->ajax()) {

            $res = new LanguageService();
            return $res->index();
        }
        return view('dashboard.language.lang_index');
    }


    // Language Form show
    public function LangForm(Request $request)
    {
        $flags = Country::all();

        return view('dashboard.language.create_lang', [
            'flags' => $flags,
        ]);
    }



    // Create Languge
    public function createLang(LanguageRequest $request)
    {

        $validateData = $request->validated();
        $createDesignation = new LanguageService();
        $data = $createDesignation->create($request);

        return $data;
    }





    // Edit Language Form
    public function editLangForm(Request $request)
    {
        $flags = Country::all();

        return view('dashboard.language.edit_lang', [
            'edit_data' => Language::find($request->id),
            'flags' => $flags,

        ]);
    }





    // Update Language Form

    public function editLang(LanguageRequest $request)
    {
        $validateData = $request->validated();
        $updateLanguage = new LanguageService();
        $data = $updateLanguage->update($request);

        return $data;
        
    }


    // Delete Language Data
    public function deleteLang(Request $request)
    {
        $deleteDesignation = new LanguageService();
        return $deleteDesignation->delete($request);
    }
}
