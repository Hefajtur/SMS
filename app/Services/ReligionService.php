<?php

namespace App\Services;

use App\Models\Religion;
use Yajra\DataTables\DataTables;

/**
 * Class ReligionService.
 */
class ReligionService
{
    private $data = [];

    public function index()
    {
        $data = Religion::all();
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
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="religion_edit" religion_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i> Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="religion_del" religion_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i> Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }



    // Create Religion
    public function create($request)
    {

        $data = new Religion();

        $data->name = $request->name;
        $data->status = $request->status;
        $data->save();

        $result['success'] = true;
        return $result;
    }



    // Update Religion
    public function update($request, $religion)
    {
        // dd($religion);
        $data = Religion::find($religion->id);
        $data->name = $request->name;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Delete Religion
    public function delete($religion)
    {

        // dd($religion);
        $del_gender = Religion::find($religion->id);

        if ($del_gender) {
            $del_gender->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
