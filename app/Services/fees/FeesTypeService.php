<?php

namespace App\Services\fees;
use App\Models\Type;
use Yajra\DataTables\DataTables;

/**
 * Class FeesTypeService.
 */
class FeesTypeService
{

    
    public function index(){
        $types = Type::latest()->get();
        return DataTables::of($types)
            ->addIndexColumn()
            ->addColumn('status', function ($types) {
                if ($types->status == 1) {
                    $active = "<span class='badge_status_act'> Active </span>";
                    return $active;
                } else {
                    return "<span class='badge_status_inact'> Inactive </span>";
                }
            })
            ->addColumn('action', function ($types) {
                $actionBtn = '<a href="" id="type_edit" type_id="' . $types->id . '" class="edit btn btn-success btn-sm">Edit</a> <a href="" id="type_delete" type_id="' . $types->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create($request){
        $type = new Type();
        $type->name = $request['name'];
        $type->code = $request['code'];
        $type->description = $request['description'];
        $type->status = $request['status'];
        $type->save();
        $data['success'] = true;
        return $data;
    }
    public function update($request, $type){      
        $type = Type::find($type->id);
        $type->name = $request['name'];
        $type->code = $request['code'];
        $type->description = $request['description'];
        $type->status = $request['status'];
        $type->save();
        $data['success'] = true;
        return $data;
    }
    public function destroy($type){      
        $type = Type::find($type->id);
        $type->delete();
        $response['success'] = true;
        return $response;
    }
    
    public function edit($id){
        $type = Type::find($id);
        return $type;
    }
}
