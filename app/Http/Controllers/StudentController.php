<?php

namespace App\Http\Controllers;

use App\helper\FileUpload;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Classes;
use App\Models\Section;
use App\Models\SchoolSession;
use App\Models\Shift;
use App\Models\Guardian;
use App\Models\StudentCategory;
use App\Services\student\StudentService;
use App\Http\Requests\Student_info\StudentRequest;
use App\Models\BloodGroup;
use App\Models\Religion;
use App\Models\Gender;
use App\Models\StudentDocument;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
class StudentController extends Controller
{
    public $response = [];

    public function index(Request $request)
    {

        if($request->ajax()){
            $studentService= new StudentService();
            return ($studentService -> index($request));

        }

        return view('dashboard.student_info.students.index', [
            'classes'  => Classes::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'dashboard.student_info.students.create',
            [
                'classes'  => Classes::all(),
                'shifts' => Shift::all(),
                'guardians' => Guardian::all(),
                'sections' => Section::all(),
                'categorys' => StudentCategory::all(),
                'genders' => Gender::all(),
                'religions' => Religion::all(),
                'bloods' => BloodGroup::all(),
                'userSessions' => SchoolSession::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentRequest $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;
        $validator = $request->validated();
        $studentService = new StudentService();
        return $studentService->create($request);

    }

    public function show($id)
    {
        return view('dashboard.student_info.students.show', [
            'students'  => Student::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        return view('dashboard.student_info.students.edit', [
            "student" => Student::find($id),
            'classes'  => Classes::all(),
            'shifts' => Shift::all(),
            'guardians' => Guardian::all(),
            'sections' => Section::all(),
            'categorys' => StudentCategory::all(),
            'genders' => Gender::all(),
            'religions' => Religion::all(),
            'bloods' => BloodGroup::all(),
            'documents' => StudentDocument::where('student_id', $id)->get(),
            'userSessions' => SchoolSession::all(),

        ]);
    }


    public function update(StudentRequest $request)
    {

        $validator = $request->validated();
        $studentService = new StudentService();
        return $studentService->update($request);
    }


    public function destroy(Student $student)
    {
        $studentService = new StudentService();
        return $studentService->destroy($student);
    }

    public function docDelete($id)
    {
        $studentService = new StudentService();
        return $studentService->docDestroy($id);
    }

    //class with section
    public function section($id)
    {
        $sectionAll = Section::where('class_id', $id)->get();
        $abc = $sectionAll->toArray();
        return $abc;
    }
   
}
