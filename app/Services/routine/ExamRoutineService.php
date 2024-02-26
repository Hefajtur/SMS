<?php

namespace App\Services\routine;
use Yajra\DataTables\DataTables;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\TimeSchedule;
use App\Models\ClassRoom;
use App\Models\ExamRoutine;
/**
 * Class ExamRoutineService.
 */
class ExamRoutineService
{

    public function index(){
       

        $data = ExamRoutine::with('class', 'section', 'examtypes')->groupBy('class_id', 'section_id','type')->get();

        // dd($data);

        return DataTables::of($data)
        ->addIndexColumn()

        ->addColumn('classAndSection', function ($data) {
            return $data->class->name . '('. $data->section->name .')';
        })

        ->addColumn('type', function ($data) {
            return $data->examtypes->name;
        })

        ->addColumn('action', function($data){
            $actionBtn = '<a href="javascript:void(0)" id="examRoutine_edit" examRoutineclass_id="'.$data->class_id.'" examRoutinesection_id="'.$data->section_id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="examRoutine_delete" examRoutineclass_id="'.$data->class_id.'" examRoutinesection_id="'.$data->section_id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
            return $actionBtn;
        })
        ->rawColumns(['action', 'classAndSection'])
        ->make(true);
}

public function create($request){

    foreach($request->subject_id as $key => $subjects){
        $examRoutine = new ExamRoutine();
        $examRoutine ->class_id= $request->class_id;
        $examRoutine ->section_id= $request->section_id;
        $examRoutine ->type= $request->type;
        $examRoutine ->date= $request->date;
        
        $examRoutine->subject_id = $subjects;       
        $examRoutine->time_schedule_id =$request->time_schedule_id[$key];                     
        $examRoutine->class_room_id =$request->class_room_id[$key];                     
        $examRoutine->save();
    }

    $this->response['success'] = true;
    return $this->response;
   
}

public function update($request, $class_id, $section_id)
{
    $updatedIds = []; 

  
    if (isset($request->subject_id) && isset($request->time_schedule_id) && isset($request->class_room_id)) {
        foreach ($request->subject_id as $key => $subject_id) {

            if (isset($request->examRoutine_id[$key])) {

                $examRoutine = ExamRoutine::find($request->examRoutine_id[$key]);
            } else {
               
                $examRoutine = new ExamRoutine();
            }

            $examRoutine->time_schedule_id =$request->time_schedule_id[$key];                     
            $examRoutine->class_room_id =$request->class_room_id[$key]; 
            $examRoutine->subject_id = $subject_id;

            $examRoutine ->class_id= $request->class_id;
            $examRoutine ->section_id= $request->section_id;
            $examRoutine ->type= $request->type;
            $examRoutine ->date= $request->date;
            $examRoutine->save();

            $updatedIds[] = $examRoutine->id; 
        }
    }

  
    ExamRoutine::where('class_id', $request->class_id)
        ->where('section_id', $request->section_id)
        ->whereNotIn('id', $updatedIds)
        ->delete();

    return response()->json(['success' => true]);
}

public function destroy($class_id , $section_id){

    $ExamRoutine = ExamRoutine::where('class_id', $class_id)->where('section_id', $section_id)->delete(); 

    $this->response['success'] = true;
    return $this->response;


}




}
