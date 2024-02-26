<?php

namespace App\Services\academic;
use App\Models\SubjectAssign;
use App\Models\Subject;
use App\Models\User;
use DataTables;
use DB;
/**
 * Class SubjectAssignService.
 */
class SubjectAssignService
{

    public function index(){
       

            $data = SubjectAssign::with('class', 'section', 'subject', 'user')->groupBy('class_id', 'section_id')->get();

            // dd($data);

            return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('classAndSection', function ($data) {
                return $data->class->name . '('. $data->section->name .')';
            })

           ->addColumn('subAndteacher', function ($data) {
                $subTec = '<a href="javascript:void(0)" id="show-user" data_url=" '.$data->section_id. '" 
                class="bg-dark border border-light rounded-circle p-2 text-white"><i class="fa-solid fa-eye"></i></a>';
                return $subTec;
            })

            ->addColumn('status', function($data){
               if($data -> status == 1 ){
                return "<span class='badge_status_act'> Active </span>";
               }else{
                return "<span class='badge_status_inact'> Inactive </span>";
               }
            })
            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" id="subjectAssign_edit" subjectAssignclass_id="'.$data->class_id.'" subjectAssignsection_id="'.$data->section_id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="subjectAssign_delete" subjectAssignclass_id="'.$data->class_id.'" subjectAssignsection_id="'.$data->section_id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'subAndteacher'])
            ->make(true);
    }

    public function modalShow($id){

        // SELECT subject_id, user_id FROM `subject_assigns` WHERE section_id=13;      
        $data = SubjectAssign::where('section_id', $id)->with('subject', 'user')->get();
        return response()->json($data);

    }

    public function create($request){

        foreach($request->subject_id as $key => $subjects){
            $subjectAssign = new SubjectAssign();
            $subjectAssign ->class_id= $request->class_id;
            $subjectAssign ->section_id= $request->section_id;
            
            $subjectAssign->subject_id = $subjects;       
            $subjectAssign->user_id =$request->user_id[$key];               
            $subjectAssign ->status = $request->status;        
            $subjectAssign->save();
        }

        $this->response['success'] = true;
        return $this->response;
       
    }


//update   
public function update($request, $class_id, $section_id)
{
    $updatedIds = []; // To keep track of ID

    if (isset($request->subject_id) && isset($request->user_id)) {
        foreach ($request->subject_id as $key => $subject_id) {
          
            if (isset($request->subjectAssign_id[$key])) {
            
                $subjectAssign = SubjectAssign::find($request->subjectAssign_id[$key]);
            } else {
             
                $subjectAssign = new SubjectAssign();
            }        
            $subjectAssign->user_id = $request->user_id[$key];
            $subjectAssign->subject_id = $subject_id;
            $subjectAssign->class_id = $request->class_id;
            $subjectAssign->section_id = $request->section_id;
            $subjectAssign->status = $request->status;
            $subjectAssign->save();

            $updatedIds[] = $subjectAssign->id; // Store the ID
        }
    }

    SubjectAssign::where('class_id', $request->class_id)
        ->where('section_id', $request->section_id)
        ->whereNotIn('id', $updatedIds)
        ->delete();

    return response()->json(['success' => true]);
}


//destroy
    public function destroy($class_id , $section_id){

        $subjectAssigns = SubjectAssign::where('class_id', $class_id)->where('section_id', $section_id)->delete(); 

        $this->response['success'] = true;
        return $this->response;
    }


    

}
