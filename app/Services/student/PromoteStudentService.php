<?php

namespace App\Services\student;

/**
 * Class PromoteStudentService.
 */
class PromoteStudentService
{

    public function index($request)
    {

        $data = Student::all();

        return DataTables::of($data)
        
            ->addIndexColumn()
            ->addColumn('studentName', function ($data) {

                return  '<a href="javascript:void(0)" id="student_show" student_id=" ' . $data->id . '></a>';
            })

            ->addColumn('result', function ($data) {

                    return "<span class='badge_status_inact'>Pending</span>";
            })
            
            ->rawColumns(['result', 'status', 'studentName', 'gender'])
            ->make(true);
    }


}
