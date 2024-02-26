<?php

namespace App\Services\examination;

use App\Models\ExamAssign;
use App\Models\MarkRegister;
use Yajra\DataTables\DataTables;

/**
 * Class MarkRegisterService.
 */
class MarkRegisterService
{
    public function markRegisterResult($request)
    {

        $selectedClass = $request->class_id;
        $section = $request->section_id;
        $exam_type = $request->exam_id;
        $subject = $request->subject_id;

        $data = MarkRegister::when($selectedClass, function ($query, $selectedClass) {
            return $query->where('class_id', $selectedClass);
        })->when($section, function ($query, $section) {
            return $query->where('section_id', $section);
        })->when($exam_type, function ($query, $exam_type) {
            return $query->where('exam_type', $exam_type);
        })->when($subject, function ($query, $subject) {
            return $query->where('subject_id', $subject);
        })->with('class', 'section', 'exam', 'students', 'subject')
        ->get();
        return response()->json(['success' => $data]);
    }
    public function subjectFind($request)
    {

        $selectedClass = $request->class_id;
        $section = $request->section;
        $exam_type = $request->exam_type;

        $data = ExamAssign::join('exam_assign_data', 'exam_assigns.id', '=', 'exam_assign_data.assign_id')->when($selectedClass, function ($query, $selectedClass) {
                return $query->where('exam_assigns.class_id', $selectedClass);
            })->when($section, function ($query, $section) {
            return $query->where('exam_assigns.section_id', $section);
        })->when($exam_type, function ($query, $exam_type) {
            return $query->where('exam_assigns.exam_type', $exam_type);
        })->with('subject')->groupBy('exam_assign_data.subject_id')->get();
        return response()->json(['success' => $data]);
    }

    // public function index()
    // {
    //     $examType = MarkRegister::with('students', 'class', 'section', 'exam', 'subject')->latest()->get();

    //     return DataTables::of($examType)
    //         ->addIndexColumn()
    //         ->addColumn('status', function ($examType) {
    //             if ($examType->status == 1) {
    //                 $active = "<span class='badge_status_act'> Active </span>";
    //                 return $active;
    //             } else {
    //                 return "<span class='badge_status_inact'> Inactive </span>";
    //             }
    //         })
    //         ->addColumn('action', function ($examType) {
    //             $actionBtn = '<a href="" id="exam_type_edit" exam_type_id="' . $examType->id . '" class="edit btn btn-success btn-sm">Edit</a> <a href="" id="exam_type_delete" exam_type_id="' . $examType->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
    //             return $actionBtn;
    //         })
    //         ->rawColumns(['action', 'status'])
    //         ->make(true);
    // }

    public function create($request)
    {
        // dd($request);
        foreach ($request->student_id as $key => $val) {
            
            $markRegister = new MarkRegister();
            $markRegister->class_id = $request->class_id;
            $markRegister->section_id = $request->section_id;
            $markRegister->exam_type = $request->exam_type;
            $markRegister->subject_id = $request->subject_id;
            $markRegister->student_id = $val;
            $markRegister->total = $request->total[$key];
            $markRegister->marks = $request->marks[$key];
            $markRegister->save();
        }
        $data['success'] = true;
            return $data;
    }

    public function update($request, $id)
    {
        
            $markRegister =  MarkRegister::find($id);
            $markRegister->class_id = $request->class_id;
            $markRegister->section_id = $request->section_id;
            $markRegister->exam_type = $request->exam_type;
            $markRegister->subject_id = $request->subject_id;
            $markRegister->total = $request->total;
            $markRegister->marks = $request->marks;
            $markRegister->save();
            $data['success'] = true;
            return $data;
       
    }
    public function destroy($examType)
    {
        $examType = ExamAssign::find($examType->id);
        $examType->delete();
        $response['success'] = true;
        return $response;
    }
    public function edit($exam_type)
    {
        $examType = ExamAssign::find($exam_type);
        return $examType;
    }
}