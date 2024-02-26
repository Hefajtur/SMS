<?php

namespace App\Services\fees;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Models\AssignData;
use Yajra\DataTables\DataTables;
/**
 * Class FeesCollectService.
 */
class FeesCollectService
{

    // public function index($request)
    // {

    //     // $data = Student::with('class', 'section', 'guardians')->latest();

    //     $data = Assign::with('students')->get();

  
    //     return DataTables::of($data)       
    //         ->addIndexColumn()

    //         ->addColumn('studentName', function ($data) {

    //             return $data->students->first_name . ' ' . $data->students->last_name ;
    //         })

    //         ->addColumn('admission_no', function ($data) {

    //             return $data->students->admission_no;
    //         })

    //         ->addColumn('Class(Section)', function ($data) {

    //             return $data->students->class->name. '(' . $data->students->section->name . ')';
    //         })

    //         ->addColumn('parent', function ($data) {

    //             return $data->students->guardians->guard_name;
    //         })

    //         ->addColumn('mobile', function ($data) {
    //             return $data->students->mobile;
    //         })

    //         ->addColumn('action', function ($data) {
    //             $actionBtn = '<a href="javascript:void(0)" id="student_show" student_id="' . $data->students_id . '" class="btn btn-danger btn-sm px-3">Collect</a>';
    //             return $actionBtn;
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }

}
