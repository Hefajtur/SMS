<?php

namespace App\Http\Controllers\religion;

use App\Http\Controllers\Controller;
use App\Http\Requests\setting\ReligionRequest;
use App\Models\religion\Religion;
use App\Services\ReligionService;
use Illuminate\Http\Request;

class ReligionController extends Controller
{
    public $data = [];

    // Religion Index
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $res = new ReligionService();
            return $res->index();
        }
        return view('dashboard.setting.religion.index');
    }



    // Create Add Religion Form
    public function create()
    {
        return view('dashboard.setting.religion.create_religion');
    }


    // Store Religion 
    public function store(ReligionRequest $request)
    {
        $validateData = $request->validated();
        $religion = new ReligionService();
        $data = $religion->create($request);
       
        return $data;
    
    }



    // editReligion
    public function edit(Religion $religion)
    {

        return view('dashboard.setting.religion.edit_religion', [
            'edit_data' => $religion,
        ]);

    }



    // update Religion
    public function update(ReligionRequest $request, Religion $religion)
    {
        // dd($religion->id);
        $validateData = $request->validated();
        $updateReligion = new ReligionService();
        $data = $updateReligion->update($request, $religion);

        return $data;
    }




    // Delete Religion Data
    public function destroy(Religion $religion)
    {
        // dd($religion);
        $deleteGender = new ReligionService();
        return $deleteGender->delete($religion);
    }

    
}
