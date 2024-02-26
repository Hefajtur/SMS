<?php

namespace App\Http\Controllers\gender;

use App\Http\Controllers\Controller;
use App\Http\Requests\setting\GenderRequest;
use App\Models\Gender;
use App\Services\GenderService;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    public $data = [];

    // Religion Index
    public function index()
    {
        if (request()->ajax()) {
            $res = new GenderService();
            return $res->index();
        }
        return view('dashboard.setting.gender.index');
    }



    // Create Gender Form
    public function create()
    {
        return view('dashboard.setting.gender.create_gender');
    }


    // Store Gender 
    public function store(GenderRequest $request)
    {
        $validateData = $request->validated();
        $createGender = new GenderService();
        $data = $createGender->create($request);
        
        return $data;
    }



    // Edit Gender Data
    public function edit(Gender $gender)
    {
        return view('dashboard.setting.gender.edit_gender', [
            'edit_data' => $gender,

        ]);
    }




    // Update Gender
    public function update(GenderRequest $request, Gender $gender)
    {
        $validateData = $request->validated();
        $updateGender = new GenderService();
        $data = $updateGender->update($request, $gender);

        return $data;
    }



    // Delete Gender
    public function destroy(Gender $gender)
    {
        $deleteGender = new GenderService();
        return $deleteGender->delete($gender);
    }
}
