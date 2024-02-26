<?php

namespace App\Services\academic;
use App\Models\Subject;
use DataTables;
/**
 * Class SubjectService.
 */
class SubjectService
{
    public function index(){

        $data = Subject::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('type', function($data){
               if($data -> type == 1 ){
                return "<span class=''>Practical</span>";
               }else{
                return "<span class=''>Theory</span>";
               }
            })
            ->addColumn('status', function($data){
                if($data -> status == 1 ){
                 return "<span class='badge_status_act'> Active </span>";
                }else{
                 return "<span class='badge_status_inact'> Inactive </span>";
                }
             })
            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" id="subject_edit" subject_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="subject_delete" subject_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'type'])
            ->make(true);
    }

    public function create($request){
      
        $subject = new Subject();
        $subject ->name= $request->name;
        $subject ->code= $request->code;
        $subject ->type= $request->type;
        $subject ->status = $request->status;        
        $subject->save();

        $this->response['success'] = true;
        return $this->response;

    }

    public function update($request, $subject){
      
        $subject = Subject::find($subject->id);
        $subject ->name= $request->name;
        $subject ->code= $request->code;
        $subject ->type= $request->type;
        $subject ->status = $request->status;        
        $subject->save();
        
        $this->response['success'] = true;
        return $this->response;


    }

    public function destroy($subject){
        
        $delete_subject = Subject::find($subject->id);
        $delete_subject->delete();

        $this->response['success'] = true;
        return $this->response;
    }
}
