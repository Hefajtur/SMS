<?php

namespace App\Services\staffManage;

use App\Models\manageStaff\RolePermission;
use App\Models\manageStaff\StaffRole;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Class StaffRoleService.
 */
class StaffRoleService
{

    private $role_permission;

    // Index Data
    public function index(Request $request)
    {
        $data = StaffRole::with('rolepermission')->get();


        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('permissions', function ($data) {
                $arr = [];
                foreach ($data['rolepermission'] as $key => $value) {
                    $e = explode(',', $value->permissions);
                    $res = array_sum($e);
                    $arr[] = $res;
                }

                $totalPermission = array_sum($arr);
                return '<span class="badge_status_act">' . $totalPermission . '</span>';
            })
            ->addColumn('status', function ($data) {

                if ($data->status == 1) {
                    return '<span class="badge_status_act">Active</span>';
                } else {
                    return '<span class="badge_status_inact">Inactive</span>';
                }
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="edit_btn" edit_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i> Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="del_btn" del_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i> Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'permissions'])
            ->make();
    }



    // Permission Array
    public function __construct()
    {
        $this->role_permission = [
            'dashboard'           =>  ['read' => 1],
            'student'             =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'student_category'    =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'promote_students'    =>  ['read' => 1, 'create' => 2],
            'disabled_students'   =>  ['read' => 1, 'create' => 2],
            'parent'              =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'admission'           =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'classes'             =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'section'             =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'shift'               =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'class_setup'         =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'subject'             =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'subject_assign'      =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'class_routine'       =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'time_schedule'       =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'class_room'          =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'fees_group'          =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'fees_type'           =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'fees_master'         =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'fees_assign'         =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'fees_collect'        =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'exam_type'           =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'marks_grade'         =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'exam_assign'         =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'exam_routine'        =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'marks_register'      =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'homework'            =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'exam_setting'        =>  ['read' => 1, 'update' => 3],
            'account_head'        =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'income'              =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'expense'             =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'attendance'          =>  ['read' => 1, 'create' => 2],
            'attendance_report'   =>  ['read' => 1],
            'marksheet'           =>  ['read' => 1],
            'merit_list'          =>  ['read' => 1],
            'progress_card'       =>  ['read' => 1],
            'due_fees'            =>  ['read' => 1],
            'fees_collection'     =>  ['read' => 1],
            'transaction'         =>  ['read' => 1],
            'language'            =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'Roles'               =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'Users'               =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'department'          =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'designation'         =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'sections'            =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'slider'              =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'about'               =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'counter'             =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'contact_info'        =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'dep_contact'         =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'news'                =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'event'               =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'gallery_category'    =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'gallery'             =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'subscribe'           =>  ['read' => 1],
            'contact_message'     =>  ['read' => 1],
            'general_settings'    =>  ['read' => 1, 'update' => 3],
            'storage_settings'    =>  ['read' => 1, 'update' => 3],
            'task_schedules'      =>  ['read' => 1, 'update' => 3],
            'software_update'     =>  ['read' => 1, 'update' => 3],
            'recaptcha_settings'  =>  ['read' => 1, 'update' => 3],
            'email_settings'      =>  ['read' => 1, 'update' => 3],
            'genders'             =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'religions'           =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'blood_groups'        =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'sessions'            =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'book_category'       =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'book'                =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'member'              =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'member_category'     =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'issue_book'          =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'online_exam_type'    =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'question_group'      =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'questionbank'        =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],
            'online_exam'         =>  ['read' => 1, 'create' => 2, 'update' => 3, 'delete' => 4],


        ];
    }


    // Store Data
    public function store($request)
    {
        // dd($request->all());

        $storeData = new StaffRole();
        $storeData->role = $request->role;
        $storeData->status = $request->status;

        $storeData->save();



        // For Permission store ---------------->
        foreach ($this->role_permission as $module => $permission) {

            $rolePermission = new RolePermission();
            $rolePermission->role_id = $storeData->id;

            if (is_array($request->input($module))) {

                $data = implode(', ', $request->input($module));
                $rolePermission->permissions = $data;
            } else {
                $rolePermission->permissions = ' ';
            }

            $rolePermission->module_name = $module;
            $rolePermission->save();
        }

        $result['success'] = true;
        return $result;
    }




    // Update Data
    public function update($request, $staffRole)
    {
        // dd($request->all());
        $storeData = StaffRole::find($staffRole->id);
        $storeData->role = $request->role;
        $storeData->status = $request->status;

        $storeData->save();


        // For Update Permission Roles ---------------->
        foreach ($this->role_permission as $module => $permission) {

            $rolePermission = RolePermission::where('role_id', $storeData->id)
                ->where('module_name', $module)
                ->first();


            if ($rolePermission) {
                if (is_array($request->input($module))) {
                    $data = implode(', ', $request->input($module));
                    $rolePermission->permissions = $data;
                } else {
                    $rolePermission->permissions = ' ';
                }
                $rolePermission->save();
            } else {

                $rolePermission = new RolePermission();
                $rolePermission->role_id = $storeData->id;
                $rolePermission->module_name = $module;
                if (is_array($request->input($module))) {
                    $data = implode(', ', $request->input($module));
                    $rolePermission->permissions = $data;
                } else {
                    $rolePermission->permissions = ' ';
                }
                $rolePermission->save();
            }
        }



        $result['success'] = true;
        return $result;
    }



    // Destroy Data
    public function destroy($data)
    {
        $del_data = StaffRole::find($data->id);
        RolePermission::where('role_id', $data->id)->delete();

        if ($del_data) {
            $del_data->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
