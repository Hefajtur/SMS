<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Student_info\PromoteStudentRequest;
use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Section;
use App\Models\SchoolSession;
use App\Models\PromoteStudent;
use App\Models\Student;
use Yajra\DataTables\DataTables;

class PromoteStudentController extends Controller
{
    public $response = [];

    public function index()
    {
        // $students = Student::with('student')->get();
        return view('dashboard.student_info.promotestudents.index',[
            'classes'  => Classes::all(),
            'sections' => Section::all(),
            'schoolSessions' => SchoolSession::all(),
        ]);
        
    }


    public function studentData(Request $request)
    {
        //  $validator = $request->validated();       
         $class = $request->class;
         $section = $request->section;
              
         $students = Student::with('guardians')->where('class_id', $class)
                             ->where('section_id', $section)
                             ->get();

        return response()->json($students);
    }


    public function promoteStudents(Request $request)
    {

        //Here students_id[] array

        foreach($request->students_id as $key => $students) {
                                
            $student = Student::find($students);
            $student->session_id = $request->session_id;
            $student->class_id = $request->promoteclass;
            $student->section_id = $request->promotesection;
            $student->save();     
        }

    return response()->json(['success' => true]);
    }


    //class with section
    public function sectionfromclass($id)
    {
         $sectionAll = Section::where('class_id', $id)->get();
         $section =$sectionAll->toArray();
         return $section;
    }
 
}
