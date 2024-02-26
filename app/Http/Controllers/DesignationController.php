<?php

namespace App\Http\Controllers;

use App\Http\Requests\staff\DesignationRequest;
use App\Models\Designation;
use App\Services\staff\DesignationService;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public $data = [];


    public function index()
    {
        if (request()->ajax()) {

            $res = new DesignationService();
            return $res->index();
        }
        return view('dashboard.staff.designation.designation');
    }



    // Create Designation Form
    public function create()
    {
        return view('dashboard.staff.designation.create_desig');
    }




    // Store Designation
    public function store(DesignationRequest $request)
    {
        // dd($request->all());
        $validateData = $request->validated();
        $designation = new DesignationService();
        $data = $designation->create($request);
       
        return $data;
    
    }



    // Edit Designation Data
    public function edit(Designation $designation)
    {
        // dd($designation->id);
        return view('dashboard.staff.designation.edit_desig', [
            'edit_data' => Designation::find($designation->id)
        ]);
    }


    // Update Designation Data
    public function update(DesignationRequest $request, Designation $designation)
    {
        // dd($designation);
        $validateDatas = $request->validated();
        $updateDesignation = new DesignationService();
        $data = $updateDesignation->update($request, $designation);

        return $data;
    }





    // Delete Designation Data
    public function destroy(Designation $designation)
    {
        $deleteDesignation = new DesignationService();
        return $deleteDesignation->delete($designation);
    }
}
