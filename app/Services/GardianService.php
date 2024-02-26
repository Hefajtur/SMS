<?php

namespace App\Services;
use App\Models\Guardian;
use App\helper\FileUpload;
use DataTables;
/**
 * Class GardianService.
 */
class GardianService
{
    public function index(){

        $data = Guardian::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('guard_status', function($data){
               if($data -> guard_status == 1 ){
                return "<span class='badge_status_act'> Active </span>";
               }else{
                return "<span class='badge_status_inact'> Inactive </span>";
               }
            })
            ->addColumn('action', function($data){
                $actionBtn = '<a href="javascript:void(0)" id="gurd_edit" gaurd-id="'.$data->id.'" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="gurd_delete" gaurd-id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'guard_status'])
            ->make(true);
    }

    public function create($request){

        $guardian = new Guardian();
        $guardian ->fath_name= $request->fath_name;
        $guardian ->fath_mobile = $request->fath_mobile;
        $guardian ->fath_prof = $request->fath_prof;
        $guardian->fath_img = FileUpload::imageUpload($request->file('fath_img'), 'gaurdian/');
        $guardian ->mother_name = $request->mother_name;
        $guardian ->mother_mobile = $request->mother_mobile;
        $guardian ->mother_prof = $request->mother_prof;
        $guardian->mother_img = FileUpload::imageUpload($request->file('mother_img'), 'gaurdian/');
        $guardian ->guard_name = $request->guard_name;
        $guardian ->guard_mobile = $request->guard_mobile;
        $guardian ->guard_prof = $request->guard_prof;
        $guardian->guard_img = FileUpload::imageUpload($request->file('guard_img'), 'gaurdian/');
        $guardian ->guard_email = $request->guard_email;
        $guardian ->guard_address = $request->guard_address;
        $guardian ->guard_rel = $request->guard_rel;
        $guardian ->guard_status = $request->guard_status;
        $guardian->save();

        $this->response['success'] = true;
        return $this->response;
    }


    public function update($request){


        $guardian = Guardian::find($request->id);

        $guardian ->fath_name= $request->fath_name;
        $guardian ->fath_mobile = $request->fath_mobile;
        $guardian ->fath_prof = $request->fath_prof;
        $guardian->fath_img = FileUpload::imageUpload($request->file('fath_img'), 'gaurdian/', isset($guardian->id) ? Guardian::find($guardian->id)->fath_img : null);
        
        $guardian ->mother_name = $request->mother_name;
        $guardian ->mother_mobile = $request->mother_mobile;
        $guardian ->mother_prof = $request->mother_prof;
        $guardian->mother_img = FileUpload::imageUpload($request->file('mother_img'), 'gaurdian/', isset($guardian->id) ? Guardian::find($guardian->id)->mother_img : null);

        $guardian ->guard_name = $request->guard_name;
        $guardian ->guard_mobile = $request->guard_mobile;
        $guardian ->guard_prof = $request->guard_prof;
        $guardian->guard_img = FileUpload::imageUpload($request->file('guard_img'), 'gaurdian/', isset($guardian->id) ? Guardian::find($guardian->id)->guard_img : null);

        $guardian ->guard_email = $request->guard_email;
        $guardian ->guard_address = $request->guard_address;
        $guardian ->guard_rel = $request->guard_rel;
        $guardian ->guard_status = $request->guard_status;
        $guardian->save();

        $this->response['success'] = true;
        return $this->response;
    }

    public function destroy($id){

        $delete_gardian = Guardian::find($id);
        $delete_gardian->delete();

        $this->response['success'] = true;
        return $this->response;
    }

}
