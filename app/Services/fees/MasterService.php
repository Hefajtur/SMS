<?php

namespace App\Services\fees;

use App\Models\Master;
use Yajra\DataTables\DataTables;

/**
 * Class MasterService.
 */
class MasterService
{

    public function index()
    {
        $masters = Master::with('groups', 'types')->latest()->get();
        return DataTables::of($masters)
            ->addIndexColumn()
            ->addColumn('status', function ($masters) {
                if ($masters->status == 1) {
                    $active = "<span class='badge_status_act'> Active </span>";
                    return $active;
                } else {
                    return "<span class='badge_status_inact'> Inactive </span>";
                }
            })
            ->addColumn('action', function ($masters) {
                $actionBtn = '<a href="" id="master_edit" master_id="' . $masters->id . '" class="edit btn btn-success btn-sm">Edit</a> <a href="" id="master_delete" master_id="' . $masters->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    
    public function create($request)
    {
        $master = new Master();
        $master->group_id = $request['group_id'];
        $master->type_id = $request['type_id'];
        $master->due_date = $request['due_date'];
        $master->amount = $request['amount'];
        $master->fine_type = $request['fine_type'];
        $master->percentage = $request['percentage'];
        $master->fine_amount = $request['fine_amount'];
        $master->status = $request['status'];
        $master->save();
        
        $data['success'] = true;
        return $data;
    }

    
    public function update($request, $master)
    {
        $master = Master::find($master->id);
        $master->group_id = $request['group_id'];
        $master->type_id = $request['type_id'];
        $master->due_date = $request['due_date'];
        $master->amount = $request['amount'];
        $master->fine_type = $request['fine_type'];
        $master->percentage = $request['percentage'];
        $master->fine_amount = $request['fine_amount'];
        $master->status = $request['status'];
        $master->save();
        $data['success'] = true;
        return $data;
    }

    public function destroy($master)
    {
        $type = Master::find($master->id);
        $type->delete();
        $response['success'] = true;
        return $response;
    }


    public function edit($master)
    {
        $type = Master::find($master->id);
        return $type;
    }
}