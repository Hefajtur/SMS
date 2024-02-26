<?php

namespace App\Services\staff;

use App\Models\Designation;
use Yajra\DataTables\DataTables;

/**
 * Class DesignationService.
 */
class DesignationService
{
    public function index()
    {
        $data = Designation::all();
        // dd($data);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                // dd($data->status);
                if ($data->status == 'active') {
                    return '<span class="badge_status_act">Active</span>';
                } else {
                    return '<span class="badge_status_inact">Inactive</span>';
                }
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="desig_edit" desig_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i> Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="desig_del" desig_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i> Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }



    // Create Designation
    public function create($request)
    {
        // dd($request->all());
        $data = new Designation();
        $data->designation = $request->designation;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Update Designation
    public function update($request, $designation)
    {
        $data = Designation::find($designation->id);
        $data->designation = $request->designation;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }




    // Delete Designation
    public function delete($designation)
    {
        $del_dept = Designation::find($designation->id);

        if ($del_dept) {
            $del_dept->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
