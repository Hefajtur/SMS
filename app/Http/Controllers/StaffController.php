<?php

namespace App\Http\Controllers;

use App\Http\Requests\staff\StaffRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Department;
use App\Models\Designation;
use App\Models\document\Document;
use App\Models\manageStaff\StaffRole;
use App\Models\Role;
use App\Models\User;
use App\Models\Userstaff;
use App\Services\staff\StaffService;
use Illuminate\Http\Request;

class StaffController extends Controller
{

    public $result;
    private $data;

    // Staff index
    public function index(Request $request)
    {

        if (request()->ajax()) {

            $res = new StaffService();
            return $res->index();
        }

        return view('dashboard.staff.staff.staff');
    }



    // Show Staff create Form
    public function createStaffForm()
    {
        $role_data = StaffRole::all();
        $desig_data = Designation::all();
        $dept_data = Department::all();

        return view('dashboard.staff.staff.create_staff', [
            'role_data' => $role_data,
            'desig_data' => $desig_data,
            'dept_data' => $dept_data,
        ]);
    }



    // Staff create
    public function createStaff(StaffRequest $request)
    {

        $validateData = $request->validated();
        $staff = new StaffService();
        $data = $staff->create($request);

        return $data;
    }



    // Show Staff
    public function showStaff()
    {
        // $all_staff = UserStaff::with('roles', 'departmnets', 'designations')->paginate(5);

        // // print_r($all_staff);


        // $data = compact('all_staff');

        // return view('dashboard.staff.staff.staff')->with($data);

        // return response()->json(['success' => $this->result]);
    }



    // Edit Staff
    public function editStaff($id)
    {

        $role_data = StaffRole::all();
        $desig_data = Designation::all();
        $dept_data = Department::all();

        return view('dashboard.staff.staff.edit_staff', [
            'edit_data' => Userstaff::find($id),
            'role_data' => $role_data,
            'desig_data' => $desig_data,
            'dept_data' => $dept_data,
            'documents' => Document::where('doc_id', $id)->get(),

        ]);
    }



    public function docDelete($id)
    {
        $studentService = new StaffService();
        return $studentService->docDestroy($id);
    }



    // Update Staff
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // $validateData = $request->validated();
        $updateUserStaff = new StaffService();
        $data = $updateUserStaff->update($request, $id);

        return $data;
    }


    // Delete Staff Data
    public function deleteStaff($id)
    {
   
        $deleteStaff = new StaffService();
        return $deleteStaff->delete($id);
       
    }
}
