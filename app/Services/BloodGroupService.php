<?php

namespace App\Services;

use App\Models\BloodGroup;
use Yajra\DataTables\DataTables;

/**
 * Class BloodGroupService.
 */
class BloodGroupService
{
    public function index()
    {
        $data = BloodGroup::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    return  '<span class="badge_status_act">Active </span>';
                } else {
                    return '<span class="badge_status_inact">Inactive </span>';
                }
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="blood_edit" blood_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i> Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="blood_del" blood_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i> Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }



    // Create Blood Group
    public function create($request)
    {
        $data = new BloodGroup();
        $data->name = $request->name;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }




    // Update Blood Group
    public function update($request, $bloodGroup)
    {
        $data = BloodGroup::find($bloodGroup->id);
        $data->name = $request->name;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }




    // Delete Blood Group
    public function delete($bloodGroup)
    {
        $del_bloodGroup = BloodGroup::find($bloodGroup->id);

        if ($del_bloodGroup) {
            $del_bloodGroup->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
