<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailSettingController extends Controller
{
    public $data = [];

    // General Settings Index
    public function index(Request $request)
    {
        $settingsData = Setting::find(1);
        $emailData = json_decode($settingsData->email_setting, true);

        // dd($emailData);

        return view('dashboard.setting.email.email_setting', compact('emailData'));
    }



    // Create Recaptcha 
    public function updateEmailSetting(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'mail_host' => 'required',
            'mail_address' => 'required',
            'form_name' => 'required',
            'mail_username' => 'required',
            'mail_port' => 'required',
        ]);

        if ($validator->passes()) {

            
            $mailData = [

                'mail_host' => $request->mail_host,
                'mail_address' => $request->mail_address,
                'form_name' => $request->form_name,
                'mail_username' => $request->mail_username,
                'mail_password' => $request->mail_password,
                'mail_port' => $request->mail_port,
                'email_encryption' => $request->email_encryption,

            ];

            $data = json_encode($mailData); 

            $setting = Setting::find(1);

            $setting->update([
                'email_setting' => $data,
            ]);

            if ($setting) {
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
