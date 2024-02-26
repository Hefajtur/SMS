<?php

namespace App\Http\Controllers;

use App\Models\DisableStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Shift;
use App\Models\Guardian;
use App\Models\Gender;
use App\Http\Requests\Student_info\disableStudentRequest;
use DataTables;

class DisableStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'dashboard.student_info.disablestudents.disable',
            [
                'classes'  => Classes::all(),
                'sections' => Section::all(),
            ]
        );
    }

    /**
     * Display the specified resource.
     */

//      public function DisableStudentData(Request $request)
// {
//     $validator = Validator::make($request->all(), [
//         'class' => 'required',
//         'section' => 'required',
//     ]);

//     if ($validator->fails()) {
//         return response()->json(['errors' => $validator->errors()], 422);
//     }

//     $class = $request->class;
//     $section = $request->section;

//     $students = Student::with('class', 'section', 'genders', 'guardians')
//         ->where('class_id', $class)
//         ->where('section_id', $section)
//         ->where('status', 0)
//         ->get();

//     return response()->json($students);
// }


    public function DisableStudentData(Request $request)
    {

    // $validator = $request->validated();
    $class = $request->class;
    $section = $request->section;

    $students = Student::with('class', 'section', 'genders', 'guardians')
        ->where('class_id', $class)
        ->where('section_id', $section)
        ->where('status', 0)
        ->get();

    return response()->json($students);
    }

     //class with section
     public function section($id)
     {
         $sectionAll = Section::where('class_id', $id)->get();
         $abc = $sectionAll->toArray();
         return $abc;
     }



}
