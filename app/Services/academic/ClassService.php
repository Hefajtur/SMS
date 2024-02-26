<?php

namespace App\Services\academic;
use App\Models\Classes;
use DataTables;
/**
 * Class StudentCategoryService.
 */
class ClassService
{
    public function index(){

        $data = Classes::latest()->get();
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
                $actionBtn = '<a href="javascript:void(0)" id="class_edit" class_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="class_delete" class_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create($request){

       
        $class = new Classes();
        $class ->name  = $request->name;
        $class ->status = $request->status;
        $class->save();

        $this->response['success'] = true;
        return $this->response;

    }


    public function update($request, $class){
      
        $class = Classes::find($class->id);
        $class ->name= $request->name;
        $class ->status = $request->status;
        $class->save();
        $this->response['success'] = true;
        return $this->response;

    }

    public function destroy($class){
        
        $delete_class = Classes::find($class->id);
        $delete_class->delete();

        $this->response['success'] = true;
        return $this->response;
    }
}