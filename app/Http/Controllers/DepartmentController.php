<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\staff\DepartmentRequest;
use App\Models\Department;
use App\Services\staff\DepartmentService;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public $data = [];

    // Department Index
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $res = new DepartmentService();
            return $res->index();
        }
       return view('dashboard.staff.department.department');
    }



    // Show Department Form
    public function create()
    {
        return view('dashboard.staff.department.create_dept');
    }



    // Store Department 
    public function store(DepartmentRequest $request)
    {        
        $validateData = $request->validated();
        $createDepartment = new DepartmentService();
        $data = $createDepartment->create($request);
       
        return $data;
        
    }



    // Edit Department Data
    public function edit(Department $department)
    { 
        return view('dashboard.staff.department.edit_dept', [
            'edit_data' => $department,
        ]);
    }




    // Update Depertment Data
    public function update(DepartmentRequest $request, Department $department)
    {
        // dd($department);

        $validateData = $request->validated();
        $updateDeparment = new DepartmentService();
        $data = $updateDeparment->update($request, $department);

        return $data;
        
    }





    // Delete Department Data
    public function destroy(Department $department)
    {
        $deleteDepartment = new DepartmentService();
        return $deleteDepartment->delete($department);
    }
}
