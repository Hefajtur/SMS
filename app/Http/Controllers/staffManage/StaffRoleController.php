<?php

namespace App\Http\Controllers\staffManage;

use App\Http\Controllers\Controller;
use App\Http\Requests\staffManage\StaffRoleRequest;
use App\Models\manageStaff\StaffRole;
use App\Services\staffManage\StaffRoleService;
use Illuminate\Http\Request;

class StaffRoleController extends Controller
{

    private $role_permission;
    public $result;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $res = new StaffRoleService();
            return $res->index($request);
        }
        return view('dashboard.staff.staffRole.index');
    }


    // For Permission
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rolePermission = $this->role_permission;

        return view('dashboard.staff.staffRole.create', ['rolePermissions' => $rolePermission]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StaffRoleRequest $request)
    {
        // dd($request->all());
        $validateData = $request->validated();
        $onlineExamData = new StaffRoleService();
        $data = $onlineExamData->store($request);

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StaffRole $staffRole)
    {
        $rolePermission = $this->role_permission;
        $rolesData = StaffRole::with('rolepermission')->where('id', $staffRole->id)->first()->toArray();

        // dd($rolesData);
        return view('dashboard.staff.staffRole.edit', [
            'data' => $rolePermission,
            'permit' => $rolesData,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StaffRoleRequest $request, StaffRole $staffRole)
    {
        // dd($request->permissionChkBox);
       
        $validateData = $request->validated();
        $updateQuestionBank = new StaffRoleService();
        $data = $updateQuestionBank->update($request, $staffRole);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StaffRole $staffRole)
    {
        $deleteStaffData = new StaffRoleService();
        return $deleteStaffData->destroy($staffRole);
    }

}
