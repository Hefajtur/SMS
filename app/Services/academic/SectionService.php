<?php

namespace App\Services\academic;
use App\Models\Section;
use DataTables;
/**
 * Class SectionService.
 */
class SectionService
{
    public function index(){

        $data = Section::with('class')->latest()->get();

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
                $actionBtn = '<a href="javascript:void(0)" id="section_edit" section_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="section_delete" section_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }


    public function create($request){

            $section = new Section();
            $section ->name= $request->name;
            $section ->class_id= $request->class_id;
            $section ->status = $request->status;        
            $section->save();

            $this->response['success'] = true;
            return $this->response;           

    }

    public function update($request, $id){

        $section = Section::find($id);
        $section ->name= $request->name;
        $section ->class_id= $request->class_id;
        $section ->status = $request->status;        
        $section->save();
        
        $this->response['success'] = true;
        return $this->response;
    }


    public function destroy($section){

        $delete_section = Section::find($section->id);
        $delete_section->delete();

        $this->response['success'] = true;
        return $this->response;
    }



}
