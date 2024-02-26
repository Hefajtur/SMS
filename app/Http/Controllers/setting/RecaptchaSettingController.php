<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecaptchaSettingController extends Controller
{
    public $data = [];

    // Recaptcha Settings Index
    public function index(Request $request)
    {
        $settingsData = Setting::find(1);
        $recaptchaData = json_decode($settingsData->recaptcha_setting, true);

        return view('dashboard.setting.recaptcha.recaptcha_setting', compact('recaptchaData'));
    }

    // Create Recaptcha 
    public function updateRecaptcha(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'recaptcha_siteKey' => 'required',
            'recaptcha_secret' => 'required',
            'recaptcha_status' => 'required',
        ]);

        if ($validator->passes()) {
            
            $recaptchaData = [

                'recaptcha_siteKey' => $request->recaptcha_siteKey,
                'recaptcha_secret' => $request->recaptcha_secret,
                'recaptcha_status' => $request->recaptcha_status,

            ];

            // dd(json_encode($recaptchaData)); 

            $data = json_encode($recaptchaData); 
            // dd($data);

            $recaptcha_setting = Setting::find(1);
            $recaptcha_setting->update([
                'recaptcha_setting' => $data,
            ]);

            if ($recaptcha_setting) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['success' => false]);
            }
        } else {
            $errors = $validator->errors();

            $data['errors'] = $errors;
            return json_encode($data);
        }
    } 
}
