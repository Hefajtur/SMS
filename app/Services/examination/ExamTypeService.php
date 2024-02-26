<?php

namespace App\Services\examination;
use App\Models\ExamType;
use Yajra\DataTables\DataTables;

/**
 * Class ExamexamTypeService.
 */
class ExamTypeService
{
    public function index(){
        $examType = ExamType::latest()->get();
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
    
    public function create($request){
        $type = new ExamType();
            $type->name = $request['name'];
            $type->status = $request['status'];
            $type->save();
            $data['success'] = true;
            return $data;
    }
    
    public function update($request, $examType){      
        $examTypes =  ExamType::find($examType->id);
        $examTypes->name = $request['name'];
        $examTypes->status = $request['status'];
        $examTypes->save();
        $data['success'] = true;
        return $data;
    }
    public function destroy($examType){      
        $examType = ExamType::find($examType->id);
        $examType->delete();
        $response['success'] = true;
        return $response;
    }
    public function edit($exam_type){
        $examType = ExamType::find($exam_type);
        return $examType;
    }

}
