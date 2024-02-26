<?php

namespace App\Services\academic;
use App\Models\Shift;
use DataTables;
/**
 * Class ShiftService.
 */
class ShiftService
{
    public function index(){

        $data = Shift::latest()->get();
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
                $actionBtn = '<a href="javascript:void(0)" id="shift_edit" shift_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="shift_delete" shift_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create($request){
      
        $shift = new Shift();
        $shift ->name= $request->name;
        $shift ->status = $request->status;        
        $shift->save();

        $this->response['success'] = true;
        return $this->response;

    }

    public function update($request, $shift){
      
        $shift = Shift::find($shift->id);
        $shift ->name= $request->name;
        $shift ->status = $request->status;        
        $shift->save();

        $this->response['success'] = true;
        return $this->response;

    }

    public function destroy($shift){
        $delete_shift = Shift::find($shift->id);
        $delete_shift->delete();

        $this->response['success'] = true;
        return $this->response;
    }


}
