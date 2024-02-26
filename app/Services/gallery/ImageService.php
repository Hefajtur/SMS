<?php

namespace App\Services\gallery;
use App\Models\Gallary;
use DataTables;
use App\helper\FileUpload;
/**
 * Class ImageService.
 */
class ImageService
{

    public function index(){

        $data = Gallary::with('gallaryCategory')->latest()->get();
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('gallaryCategory', function ($data) {
            return $data->gallaryCategory->name;
        })

        ->addColumn('image', function ($data) {
            return  '<img src="' . $data->image . '" alt="" style="height: 60px; width: 60px">';
        })

        ->addColumn('status', function($data){
            if($data -> status == 1 ){
             return "<span class='badge_status_act'> Active </span>";
            }else{
             return "<span class='badge_status_inact'> Inactive </span>";
            }
         })

            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" id="image_edit" image_id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="image_delete" image_id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })

            
            ->rawColumns(['action','image', 'status'])
            ->make(true);
    }

     


    public function create($request)
    {

        $gallary = new Gallary();
        $gallary->gallary_category_id  = $request->gallary_category_id ;
        $gallary->image = FileUpload::imageUpload($request->file('image'), 'gallery/');
        $gallary->status = $request->status;
        $gallary->save();

        $this->response['success'] = true;
        return $this->response;
    }


    public function update($request){
      
        $gallary = Gallary::find($request->id);
        $gallary->gallary_category_id  = $request->gallary_category_id ;
        $gallary->image = FileUpload::imageUpload($request->file('image'), 'gallery/', isset($gallary->id) ? Gallary::find($gallary->id)->image : null);
        $gallary->status = $request->status;
        $gallary->save();

        $this->response['success'] = true;
        return $this->response;

    }


    public function destroy($id){
        
        $delete_gallary = Gallary::find($id);
        $delete_gallary->delete();

        $this->response['success'] = true;
        return $this->response;
    }
}
