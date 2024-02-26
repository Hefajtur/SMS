<?php

namespace App\Services\examination;

use App\Models\ExamAssign;

use App\Models\ExamAssignData;
use Yajra\DataTables\DataTables;

/**
 * Class ExamAssignService.
 */
class ExamAssignService
{
    public function index()
    {

        $examType = ExamAssign::with('parents')->latest()->get();

        return DataTables::of($examType)
            ->addIndexColumn()
            ->addColumn('status', function ($examType) {
                if ($examType->status == 1) {
                    $active = "<span class='badge_status_act'> Active </span>";
                    return $active;
                } else {
                    return "<span class='badge_status_inact'> Inactive </span>";
                }
            })
            ->addColumn('action', function ($examType) {
                $actionBtn = '<a href="" id="exam_type_edit" exam_type_id="' . $examType->id . '" class="edit btn btn-success btn-sm">Edit</a> <a href="" id="exam_type_delete" exam_type_id="' . $examType->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create($request)
    {
        $examAssign = new ExamAssign();
        foreach ($request['exam_type'] as $examTypeId) {
            foreach ($request['section_id'] as $sectionId) {
                $examAssign = new ExamAssign();
                $examAssign->exam_type = $examTypeId;
                $examAssign->class_id = $request['class_id'];
                $examAssign->section_id = $sectionId;
                $examAssign->save();

                foreach ($request['subject_id'] as $subjectId) {
                    foreach ($request->input("title.$subjectId") as $examId => $title) {
                        $marks = $request->input("marks.$subjectId.$examId");
                        $examAssignData = new ExamAssignData();
                        $examAssignData->assign_id = $examAssign->id;
                        $examAssignData->subject_id = $subjectId;
                        $examAssignData->title = $title;
                        $examAssignData->marks = $marks;
                        $examAssignData->save();
                    }
                }
            }
        }
        $data['success'] = true;
        return $data;
    }

    public function update($request, $id)
    {
        foreach ($request['exam_type'] as $examTypeId) {
            foreach ($request['section_id'] as $sectionId) {
                $examAssign = ExamAssign::find($id);
                $examAssign->exam_type = $examTypeId;
                $examAssign->class_id = $request['class_id'];
                $examAssign->section_id = $sectionId;
                $examAssign->save();

                foreach ($request['subject_id'] as $subjectId) {
                    foreach ($request->input("title.$subjectId") as $examId => $title) {
                        $examAssignData = ExamAssignData::find($request->aid[$examId]);
                        $marks = $request->input("marks.$subjectId.$examId");
                        $examAssignData->assign_id = $examAssign->id;
                        $examAssignData->subject_id = $subjectId;
                        $examAssignData->title = $title;
                        $examAssignData->marks = $marks;
                        $examAssignData->save();
                    }
                    
                }
               
            }
        }
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