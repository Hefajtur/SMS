<?php

namespace App\Services\staff;

use App\Models\Department;
use Yajra\DataTables\DataTables;

/**
 * Class DepartmentService.
 */
class DepartmentService
{
    public function index()
    {
        $data = Department::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {

                if ($data->status == 1) {
                    return '<span class="badge_status_act">Active</span>';
                } else {
                    return '<span class="badge_status_inact">Inactive</span>';
                }
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="dept_edit" dept_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i> Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="dept_del" dept_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i> Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }


    // Create Department
    public function create($request)
    {
        $data = new Department();
        $data->department = $request->department;
        $data->status = $request->status;
        $data->save();
        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }


    // Update Department
    public function update($request, $department)
    {
        $data = Department::find($department->id);
        $data->department = $request->department;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Delete Department
    public function delete($department)
    {
        $del_dept = Department::find($department->id);

        if ($del_dept) {
            $del_dept->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
