<?php

namespace App\Http\Controllers\generalSetting;

use App\Http\Controllers\Controller;
use App\Models\SchoolSession;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{

    public $data = [];

    // General Settings Index
    public function index(Request $request)
    {
        $sessions = SchoolSession::all();
        $settingsData = Setting::find(1);
        $generalData = json_decode($settingsData->general_setting, true);

        // dd($generalData);

        return view('dashboard.setting.general.gen_setting', [
            'sessions' => $sessions,
            'generalData' => $generalData,
        ]);
    }




    // Create updategenSetting 
    public function updategenSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'footer_text' => 'required',  
            'default_lang' => 'required',
            'currency' => 'required',
            'session' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'school' => 'required',
        ]);

        if ($validator->passes()) {

            // Light Logo
            $lightLogo = time() . '_' . $request->file('light_img')->getClientOriginalName();
            $file = $request->file('light_img')->move('uploads', $lightLogo);
            $lightLogoName = 'uploads/' . $lightLogo;


            // Dark Logo
            $darkLogo = time() . '_' . $request->file('dark_img')->getClientOriginalName();
            $file = $request->file('dark_img')->move('uploads', $darkLogo);
            $darkLogoName = 'uploads/' . $darkLogo;


            // Favicon
            $favicon = time() . '_' . $request->file('favicon')->getClientOriginalName();
            $file = $request->file('favicon')->move('uploads', $favicon);
            $faviconName = 'uploads/' . $favicon;

            $generalSettingData = [

                'app_name' => $request->name,
                'footer_text' => $request->footer_text,
                'lightLogo' => $lightLogoName,
                'darkLogo' => $darkLogoName,
                'favicon' => $faviconName,
                'default_lang' => $request->default_lang,
                'currency' => $request->currency,
                'session' => $request->session,
                'address' => $request->address,
                'email' => $request->email,
                'phone' => $request->phone,
                'school' => $request->school,

            ];

            // dd(json_encode($generalSettingData)); 

            $data = json_encode($generalSettingData); 
  

            $genSettingData = Setting::find(1);
            $genSettingData->update([
                'general_setting' => $data,
            ]);

            if ($genSettingData) {
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
