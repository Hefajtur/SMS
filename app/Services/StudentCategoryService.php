<?php

namespace App\Services;
use App\Models\StudentCategory;
use DataTables;
/**
 * Class StudentCategoryService.
 */
class StudentCategoryService
{
    public function index(){

        $data = StudentCategory::latest()->get();
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
                $actionBtn = '<a href="javascript:void(0)" id="category_edit" category_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="category_delete" category_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create($request){

        $class = new StudentCategory();
        $class ->name= $request->name;
        $class ->status = $request->status;
        $class->save();

       $this->response['success'] = true;
       return $this->response;

    }


    public function update($request, $studentCategory){
      
        $class = StudentCategory::find($studentCategory->id);
        $class ->name= $request->name;
        $class ->status = $request->status;
        $class->save();
        $this->response['success'] = true;
        return $this->response;

    }


    public function destroy($studentCategory){
        $delete_category = StudentCategory::find($studentCategory->id);
        $delete_category->delete();

        $this->response['success'] = true;
        return $this->response;
    }
}
