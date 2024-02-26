<?php

namespace App\Services\academic;
use App\Models\ClassRoom;
use DataTables;
/**
 * Class ClassRoomService.
 */
class ClassRoomService
{
    public function index(){

        $data = ClassRoom::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($data){
                if($data -> status == 0 ){
                 return "<span class='badge_status_act'> Active </span>";
                }else{
                 return "<span class='badge_status_inact'> Inactive </span>";
                }
             })
            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" id="classRoom_edit" classRoom_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="classRoom_delete" classRoom_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create($request){
 
        $ClassRoom = new ClassRoom();
        $ClassRoom ->room_no= $request->room_no;
        $ClassRoom ->capacity = $request->capacity;        
        $ClassRoom ->status= $request->status;
        $ClassRoom->save();
        
        $this->response['success'] = true;
        return $this->response;

    }

    public function update($request, $classRoom){
      
       
        $ClassRoom = ClassRoom::find($classRoom->id);
        $ClassRoom ->room_no= $request->room_no;
        $ClassRoom ->capacity = $request->capacity;        
        $ClassRoom ->status= $request->status;
        $ClassRoom->save();

        $this->response['success'] = true;
        return $this->response;



    }

    public function destroy($classRoom){
        
        $delete_ClassRoom = ClassRoom::find($classRoom->id);
        $delete_ClassRoom->delete();

        $this->response['success'] = true;
        return $this->response;
    }

}
