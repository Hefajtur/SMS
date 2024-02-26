<?php

namespace App\Http\Controllers\setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StorageSettingController extends Controller
{
    public $data = [];

    // General Settings Index
    public function index()
    {
        $settingsData = Setting::find(1);
        $storageData = json_decode($settingsData->storage_setting, true);

        return view('dashboard.setting.storage.storage_setting', compact('storageData'));
    }

    // updateStorage 
    public function updateStorage(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'fileSystem' => 'required',
            'aws_accessKey' => 'required',
            'aws_secretKey' => 'required',
            'aws_defaultRegion' => 'required',
            'aws_bucket' => 'required',
            'aws_endpoint' => 'required',
        ]);

        if ($validator->passes()) {
            
            $storeData = [

                'fileSystem' => $request->fileSystem,
                'aws_accessKey' => $request->aws_accessKey,
                'aws_secretKey' => $request->aws_secretKey,
                'aws_defaultRegion' => $request->aws_defaultRegion,
                'aws_bucket' => $request->aws_bucket,
                'aws_endpoint' => $request->aws_endpoint,

            ];

            $data = json_encode($storeData); 
            // dd($data);

            $setting = Setting::find(1);

            $setting->update([
                'storage_setting' => $data,
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
