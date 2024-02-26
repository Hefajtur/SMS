<?php

namespace App\Services\routine;
use Yajra\DataTables\DataTables;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Shift;
use App\Models\Day;
use App\Models\Subject;
use App\Models\TimeSchedule;
use App\Models\ClassRoom;
use App\Models\ClassRoutine;
/**
 * Class ClassRoutineService.
 */
class ClassRoutineService
{

    public function index(){
       

        $data = ClassRoutine::with('class', 'section', 'shift', 'days')->groupBy('class_id', 'section_id',  'shift_id')->get();

        // dd($data);

        return DataTables::of($data)
        ->addIndexColumn()

        ->addColumn('classAndSection', function ($data) {
            return $data->class->name . '('. $data->section->name .')';
        })

        ->addColumn('shift', function ($data) {
            return $data->shift->name;
        })

        ->addColumn('day', function ($data) {
            return $data->days->day;
        })

        ->addColumn('action', function($data){
            $actionBtn = '<a href="javascript:void(0)" id="classRoutine_edit" classRoutineclass_id="'.$data->class_id.'" classRoutinesection_id="'.$data->section_id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="classRoutine_delete" classRoutineclass_id="'.$data->class_id.'" classRoutinesection_id="'.$data->section_id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
            return $actionBtn;
        })
        ->rawColumns(['action', 'classAndSection', 'shift', 'day'])
        ->make(true);
}


public function create($request){

    foreach($request->subject_id as $key => $subjects){
        $classRoutine = new ClassRoutine();
        $classRoutine ->class_id= $request->class_id;
        $classRoutine ->section_id= $request->section_id;
        $classRoutine ->shift_id= $request->shift_id;
        $classRoutine ->day= $request->day;
        
        $classRoutine->subject_id = $subjects;       
        $classRoutine->time_schedule_id =$request->time_schedule_id[$key];                     
        $classRoutine->class_room_id =$request->class_room_id[$key];                     
        $classRoutine->save();
    }

    $this->response['success'] = true;
    return $this->response;
   
}


public function update($request, $class_id, $section_id)
{
    $updatedIds = []; 

    
    if (isset($request->subject_id) && isset($request->time_schedule_id) && isset($request->class_room_id)) {
        foreach ($request->subject_id as $key => $subject_id) {

            if (isset($request->classRoutine_id[$key])) {

                $classRoutine = ClassRoutine::find($request->classRoutine_id[$key]);
            } else {
                
                $classRoutine = new ClassRoutine();
            }

            $classRoutine->time_schedule_id =$request->time_schedule_id[$key];                     
            $classRoutine->class_room_id =$request->class_room_id[$key]; 
            $classRoutine->subject_id = $subject_id;

            $classRoutine ->class_id= $request->class_id;
            $classRoutine ->section_id= $request->section_id;
            $classRoutine ->shift_id= $request->shift_id;
            $classRoutine ->day= $request->day;
            $classRoutine->save();

            $updatedIds[] = $classRoutine->id; 
        }
    }

 
    ClassRoutine::where('class_id', $request->class_id)
        ->where('section_id', $request->section_id)
        ->whereNotIn('id', $updatedIds)
        ->delete();

    return response()->json(['success' => true]);
}



public function destroy($class_id , $section_id){

  
    $classRoutine = ClassRoutine::where('class_id', $class_id)->where('section_id', $section_id)->delete(); 

    $this->response['success'] = true;
    return $this->response;
}

}
