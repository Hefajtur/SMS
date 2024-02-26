<?php

namespace App\Http\Controllers\examination;

use App\Http\Controllers\Controller;
use App\Http\Requests\examination\ExamAssignRequest;
use App\Models\ExamAssign;
use App\Models\ExamAssignData;
use App\Services\examination\ExamAssignService;
use Illuminate\Http\Request;
use App\Models\ExamType;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Section;
use Illuminate\Support\Facades\Validator;

class ExamAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            return view('dashboard.examination.exam_assign.index', [
            'examTypes' => ExamType::all(),
            'classes' => Classes::all(),
            'subjects' => Subject::all(),
        ]);
    }

    public function create()
    {
        return view('dashboard.examination.exam_assign.create', [
            'examTypes' => ExamType::all(),
            'classes' => Classes::all(),
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamAssignRequest $request)
    {
        $validateData = $request->validated();
        $assignService = new ExamAssignService();
        return $assignService->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $exam_type = $request->exam_id;
        $selectedClass = $request->class_id;
        $section = $request->section_id;
        $subject = $request->subject_id;
        $data = ExamAssign::join('exam_assign_data', 'exam_assigns.id', '=', 'exam_assign_data.assign_id')
        ->when($selectedClass, function ($query, $selectedClass) {
            return $query->where('exam_assigns.class_id', $selectedClass);
        })->when($section, function ($query, $section) {
            return $query->where('exam_assigns.section_id', $section);
        })->when($exam_type, function ($query, $exam_type) {
            return $query->where('exam_assigns.exam_type', $exam_type);
        })->when($subject, function ($query, $subject) {
            return $query->where('exam_assign_data.subject_id', $subject);
        })->with('class', 'section', 'exam', 'subject')->get();
            return response()->json(['success' => $data]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $exam_assign = ExamAssign::with('section', 'parents')->find($id);
       
        return view('dashboard.examination.exam_assign.edit', [
            'exam_assign' => $exam_assign,
            'examTypes' => ExamType::all(),
            'classes' => Classes::all(),
            'subjects' => Subject::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamAssignRequest $request,  $id)
    {
        $validateData = $request->validated();
        $assignService = new ExamAssignService();
        return $assignService->update($request, $id);
       
    }

    public function destroy( $id, $exam_type, $subject_id, $section_id)
    {
        $examAssign = ExamAssign::where('id', $id)->where('exam_type', $exam_type)->where('section_id', $section_id)->first();
        $examAssignData = ExamAssignData::where('assign_id', $examAssign->id)->where('subject_id', $subject_id)->first();
        $examAssignData->delete();
        $examAssign->delete();
        return response()->json(['success' => true]);
    }


    public function section($id)
    {
        $abc = Section::where('class_id', $id)->get();

        return $abc;
    }
}