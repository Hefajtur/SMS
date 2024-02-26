<?php

namespace App\Services;

use App\Models\Gender;
use Yajra\DataTables\DataTables;

/**
 * Class GenderService.
 */
class GenderService
{
    public function index()
    {
        $data = Gender::all();
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
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="gender_edit" gender_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i> Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="gender_del" gender_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i> Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }




    // Create Gender
    public function create($request)
    {
        $data = new Gender();
        $data->name = $request->name;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Update Gender
    public function update($request, $gender)
    {
        $data = Gender::find($gender->id);
        $data->name = $request->name;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Delete Gender
    public function delete($gender)
    {
        $del_gender = Gender::find($gender->id);

        if ($del_gender) {
            $del_gender->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
