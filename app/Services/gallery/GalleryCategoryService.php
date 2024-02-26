<?php

namespace App\Services\gallery;
use App\Models\GallaryCategory;
use DataTables;
/**
 * Class GalleryCategoryService.
 */
class GalleryCategoryService
{

    public function index(){

        $data = GallaryCategory::latest()->get();
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
                $actionBtn = '<a href="javascript:void(0)" id="galleryCategory_edit" galleryCategory_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="galleryCategory_delete" galleryCategory_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create($request){   
        $GallaryCategory = new GallaryCategory();
        $GallaryCategory ->name= $request->name;
        $GallaryCategory ->status = $request->status;
        $GallaryCategory->save();

        $this->response['success'] = true;
        return $this->response;

    }


    public function update($request, $id){
      
        $GallaryCategory = GallaryCategory::find($id);
        $GallaryCategory ->name= $request->name;
        $GallaryCategory ->status = $request->status;
        $GallaryCategory->save();

        $this->response['success'] = true;
        return $this->response;

    }


    public function destroy($id){
        
        $delete_GallaryCategory = GallaryCategory::find($id);
        $delete_GallaryCategory->delete();

        $this->response['success'] = true;
        return $this->response;
    }
}
