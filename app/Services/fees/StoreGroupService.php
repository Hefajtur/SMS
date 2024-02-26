<?php

namespace App\Services\fees;
use App\Models\Group;
use Yajra\DataTables\DataTables;

/**
 * Class StoreGroupService.
 */
class StoreGroupService
{
    public function index(){
        $groups = Group::latest()->get();

        return DataTables::of($groups)
            ->addIndexColumn()
            ->addColumn('status', function ($groups) {
                if ($groups->status == 1) {
                    $active = "<span class='badge_status_act'> Active </span>";
                    return $active;
                } else {
                    return "<span class='badge_status_inact'> Inactive </span>";
                }
            })
            ->addColumn('action', function ($groups) {
                $actionBtn = '<a href="" id="group_edit" group_id="' . $groups->id . '" class="edit btn btn-success btn-sm">Edit</a> <a href="" id="group_delete" group_id="' . $groups->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create($request){
        $group = new Group();
        $group->name = $request['name'];
        $group->description = $request['description'];
        $group->status = $request['status'];
        $group->save();

        $response['success'] = true;
        return $response;

    }

    public function update($request, $group){      
        $group = Group::find($group->id);
        $group->name = $request['name'];
        $group->description = $request['description'];
        $group->status = $request['status'];
        $group->save();
        
        $response['success'] = true;
        return $response;
    }

    public function destroy($group){      
        $group = Group::find($group->id);
        $group->delete();
        $response['success'] = true;
        return $response;
    }

}
