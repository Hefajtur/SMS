<?php

namespace App\Services\academic;
use App\Models\TimeSchedule;
use DataTables;
/**
 * Class TimeScheduleService.
 */
class TimeScheduleService
{
    public function index(){

        $data = TimeSchedule::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($data){
                if($data -> status == 1 ){
                 return "<span class='badge_status_act'> Active </span>";
                }else{
                 return "<span class='badge_status_inact'> Inactive </span>";
                }
             })
            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" id="timeSchedule_edit" timeSchedule_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="timeSchedule_delete" timeSchedule_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create($request){
 
        $timeSchedule = new TimeSchedule();
        $timeSchedule ->type= $request->type;
        $timeSchedule ->status= $request->status;
        $timeSchedule ->start_time= $request->start_time;
        $timeSchedule ->end_time = $request->end_time;        
        $timeSchedule->save();

        $this->response['success'] = true;
        return $this->response;


    }

    public function update($request, $timeSchedule){
      
        $timeSchedule = TimeSchedule::find($timeSchedule->id);
        $timeSchedule ->type= $request->type;
        $timeSchedule ->status= $request->status;
        $timeSchedule ->start_time= $request->start_time;
        $timeSchedule ->end_time = $request->end_time;        
        $timeSchedule->save();

        $this->response['success'] = true;
        return $this->response;


    }

    public function destroy($timeSchedule){
        
        $delete_timeSchedule = TimeSchedule::find($timeSchedule->id);
        $delete_timeSchedule->delete();

        $this->response['success'] = true;
        return $this->response;
    }

}
