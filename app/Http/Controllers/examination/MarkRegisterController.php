<?php

namespace App\Http\Controllers\examination;

use App\Http\Controllers\Controller;
use App\Http\Requests\examination\MarkRegisterRequest;
use App\Models\Classes;
use App\Models\ExamAssign;
use App\Models\ExamType;
use App\Models\MarkAndStudent;
use App\Models\MarkRegister;
use App\Models\Student;
use App\Models\Subject;
use App\Services\examination\MarkRegisterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class MarkRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.examination.mark_register.index', [
            'examTypes' => ExamType::all(),
            'classes' => Classes::all(),
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.examination.mark_register.create', [
            'examTypes' => ExamType::all(),
            'classes' => Classes::all(),
            'subjects' => Subject::all(),
        ]);
    }
    public function subjectsForMarkRegister(Request $request)
    {
        $assignService = new MarkRegisterService();
        return $assignService->subjectFind($request);
    }
    public function markRegisterResult(Request $request)
    {
        $assignService = new MarkRegisterService();
        return $assignService->markRegisterResult($request);
    }
    public function studentsForMarkRegister(Request $request)
    {
        $selectedClass = $request->class_id;
        $section = $request->section;
        $exam_type = $request->exam_type;
        $subject = $request->subject;

        $data = ExamAssign::join('exam_assign_data', 'exam_assigns.id', '=', 'exam_assign_data.assign_id')
            ->when($selectedClass, function ($query, $selectedClass) {
                return $query->where('exam_assigns.class_id', $selectedClass);
            })->when($section, function ($query, $section) {
            return $query->where('exam_assigns.section_id', $section);
        })->when($exam_type, function ($query, $exam_type) {
            return $query->where('exam_assigns.exam_type', $exam_type);
        })->when($subject, function ($query, $subject) {
            return $query->where('exam_assign_data.subject_id', $subject);
        })->get();

        // return response()->json(['success' => $data]);

        $students = Student::where('class_id', $selectedClass)->where('section_id', $section)->get();
        return response()->json(['success' => $students, 'marks' => $data]);
        // dd($abc);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(MarkRegisterRequest $request)
    {
        $validateData = $request->validated();
        $assignService = new MarkRegisterService();
        return $assignService->create($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }


    public function edit(string $id)
    {
        $markReg = MarkRegister::with('class', 'section', 'exam', 'subject', 'students')->find($id);
        //    dd($markReg);
        return view('dashboard.examination.mark_register.edit', [
            'markReg' => $markReg,
            'examTypes' => ExamType::all(),
            'classes' => Classes::all(),
        ]);
    }

    public function update(MarkRegisterRequest $request, $id)
    {
        $validateData = $request->validated();
        $assignService = new MarkRegisterService();
        return $assignService->update($request, $id);
    }

    public function destroy($id)
    {
        // dd($id);
        $markRegister = MarkRegister::find($id);
        if ($markRegister) {
            $markRegister->delete();
            $data['success'] = true;
            return $data;
        } else {
            $data['success'] = false;
            return $data;
        }

    }
}