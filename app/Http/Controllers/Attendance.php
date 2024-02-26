<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\RolePermission;
use App\Services\staff\RoleService;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class RoleController extends Controller
{

    private $role_permission;
    public $result;


    // Role Index
    public function index()
    {
        if (request()->ajax()) {

            $res = new RoleService();
            return $res->index();
        }
        return view('dashboard.staff.role.role');
    }


    public function __construct()
    {
        $this->role_permission = [
            'dashboard'           =>  ['read' => 0],
            'student'             =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'student_category'    =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'promote_students'    =>  ['read' => 0, 'create' => 0],
            'disabled_students'   =>  ['read' => 0, 'create' => 0],
            'parent'              =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'admission'           =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'classes'             =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'section'             =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'shift'               =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'class_setup'         =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'subject'             =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'subject_assign'      =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'class_routine'       =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'time_schedule'       =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'class_room'          =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'fees_group'          =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'fees_type'           =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'fees_master'         =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'fees_assign'         =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'fees_collect'        =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'exam_type'           =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'marks_grade'         =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'exam_assign'         =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'exam_routine'        =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'marks_register'      =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'homework'            =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'exam_setting'        =>  ['read' => 0, 'update' => 0],
            'account_head'        =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'income'              =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'expense'             =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'attendance'          =>  ['read' => 0, 'create' => 0],
            'attendance_report'   =>  ['read' => 0],
            'marksheet'           =>  ['read' => 0],
            'merit_list'          =>  ['read' => 0],
            'progress_card'       =>  ['read' => 0],
            'due_fees'            =>  ['read' => 0],
            'fees_collection'     =>  ['read' => 0],
            'transaction'         =>  ['read' => 0],
            'language'            =>  ['read' => 0, 'create' => 0, 'update' => 0, 'update_terms', 'delete' => 0],
            'Roles'               =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'Users'               =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'department'          =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'designation'         =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'sections'            =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'slider'              =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'about'               =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'counter'             =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'contact_info'        =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'dep_contact'         =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'news'                =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'event'               =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'gallery_category'    =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'gallery'             =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'subscribe'           =>  ['read' => 0],
            'contact_message'     =>  ['read' => 0],
            'general_settings'    =>  ['read' => 0, 'update' => 0],
            'storage_settings'    =>  ['read' => 0, 'update' => 0],
            'task_schedules'      =>  ['read' => 0, 'update' => 0],
            'software_update'     =>  ['read' => 0, 'update' => 0],
            'recaptcha_settings'  =>  ['read' => 0, 'update' => 0],
            'email_settings'      =>  ['read' => 0, 'update' => 0],
            'genders'             =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'religions'           =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'blood_groups'        =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'sessions'            =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'book_category'       =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'book'                =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'member'              =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'member_category'     =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'issue_book'          =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'online_exam_type'    =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'question_group'      =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'questionbank'       =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],
            'online_exam'         =>  ['read' => 0, 'create' => 0, 'update' => 0, 'delete' => 0],


        ];
    }


    // Show Role create Form
    public function createroleForm()
    {
        $x = $this->role_permission;

        // echo '<pre>';
        // print_r($x);
        // die();

        return view('dashboard.staff.role.create_role', ['data' => $x]);
    }


    // Create Role (Insert Data)
    public function createRole(Request $request)
    {

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'role' => 'required|unique:Roles',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            // Insert Data to Role Table
            $role = new Role();
            $role->role = $request->role;
            $role->status = $request->status;
            $role->save();

            // Get Last ID form Role Table
            $role_last_id = $role->id;


            // Insert Data to Role-Permission Table
            foreach ($this->role_permission as $module => $permission) {

                $rolePermission = new RolePermission();
                $rolePermission->role_id = $role_last_id;

                if (is_array($request->input($module))) {
                    $rolePermission->permissions = implode(',', $request->input($module));
                } else {
                    $rolePermission->permissions = '';
                }

                $rolePermission->module_name = $module;
                $rolePermission->save();
            }

            if ($role) {

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



    // Show Role Data
    public function showRole()
    {
        $rolesData = Role::with('permission')->get();
        // print_r($rolesData);
        // die();
        $this->result = $rolesData;

        return response()->json(['success' => $this->result]);
    }



    // Edit Role Data
    public function editRoleForm(Request $request)
    {
        $rolesData = Role::with('permission')->where('id', $request->id)->first()->toArray();


        $x = $this->role_permission;

        foreach ($x as $key => $value) {
            foreach ($rolesData['permission'] as $v) {
                if ($key == $v['module_name']) {
                    $o = $x[$key];
                    $s = explode(',', $v['permissions']);
                    foreach ($s as $p) {
                        if ($p != '')
                            $o[$p] = 1;
                    }

                    $x[$key] = $o;
                }
            }
        }

        return view('dashboard.staff.role.edit_role', [
            'data' => $x,
            'permit' => $rolesData,
        ]);
    }




    // Update Role
    public function updateRole(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'role' => 'required',
            'status' => 'required',
        ]);

        if ($validator->passes()) {

            // Insert Data to Role Table
            $role = Role::find($request->id);
            $role->role = $request->role;
            $role->status = $request->status;
            $role->save();

            // Get Last ID form Role Table
            $role_last_id = $role->id;


            // Insert Data to Role-Permission Table
            foreach ($this->role_permission as $module => $permission) {

                $rolePermission = RolePermission::find($request->id);
                $rolePermission->role_id = $role_last_id;

                if (is_array($request->input($module))) {
                    $rolePermission->permissions = implode(',', $request->input($module));
                } else {
                    $rolePermission->permissions = '';
                }

                $rolePermission->module_name = $module;
                $rolePermission->save();
            }

            if ($role) {

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




    // Role Delete
    public function deleteRole(Request $request) {
        $del_role = Role::find($request->id);

        if ($del_role) {
            $data = $del_role->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
