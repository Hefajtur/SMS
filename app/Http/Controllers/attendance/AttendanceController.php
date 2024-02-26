<?php

namespace App\Http\Controllers\attendance;

use App\Http\Controllers\Controller;
use App\Models\attendance\Attendance;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;

class AttendanceController extends Controller
{

    protected $attandanceData;

    public function __construct()
    {
        $this->attandanceData = [
            ['label' => 'Present', 'value' => 'P'],
            ['label' => 'Late', 'value' => 'L'],
            ['label' => 'Absent', 'value' => 'A'],
            ['label' => 'Half Day', 'value' => 'F'],
        ];
    }


    // Attendace Index
    public function attendanceIndex(Request $request)
    {
        $exam_type = $request->class_id;
        $selectedClass = $request->class_id;
        $selectedSection = $request->section_id;
        $subject_id = $request->subject_id;
        // dd($request);

       

        $classData = Classes::all();
        $sectionData = Section::all();
        $studentsData = Student::all();
        return view('dashboard.attendances.attendance.attend_index', [
            'classData' => $classData,
            'sectionData' => $sectionData,
            'studentsData' => $studentsData,
            // 'attandData' => $this->attandanceData,
        ]);
    }



    // Attendace Search data
    public function attendanceSearch()
    {

        $classData = Classes::all();
        $sectionData = Section::all();
        $studentsData = Student::all();
        return view('dashboard.attendances.attendance.attend_search', [
            'classData' => $classData,
            'sectionData' => $sectionData,
            'studentsData' => $studentsData,
            'attandData' => $this->attandanceData,
        ]);
    }


    public function attend_section($id)
    {
        $sectionAll = Section::where('class_id', $id)->get();
        $sections = $sectionAll->toArray();
        return $sections;
    }


    //Filter Student
    public function get_student_by_class_section_keyword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'select_class' => 'required',
            'select_section' => 'required',
            'attendanceDate' => 'required',
        ]);

        if ($validator->passes()) {
            $selectedClass = $request->select_class;
            $selectedSection = $request->select_section;

            $student = Student::where('class_id', $selectedClass)->where('section_id', $selectedSection)->with('class', 'section')->get();

            return response()->json([
                'success' => $student,
                'attendance' => $this->attandanceData
            ]);
        } else {
            $errors = $validator->errors();

            $data['errors'] = $errors;
            return json_encode($data);
        }
    }



    // Attendance submit
    public function attendanceSubmit(Request $request)
    {
        // dd($request->all());
        foreach($request->std_id as $key => $id) {

            $attandanceData = new Attendance();
            $attandanceData->std_id = $id;        
            $attandanceData->attendance = $request->attendType[$key];
            $attandanceData->note = $request->note[$key];
            $attandanceData->attendance_date = $request->attendanceDate;
            $attandanceData->save();            
            
        }

        if($attandanceData) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }

    }
}
