<?php

namespace App\Services\onlineExam;

use App\Models\onlineExam\OnlineExamType;
use Yajra\DataTables\DataTables;

/**
 * Class OnlineExamTypeService.
 */
class OnlineExamTypeService
{

    // Online Exam Type Index
    public function index()
    {
        $data = OnlineExamType::get();
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
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="examType_edit" examType_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="examType_del" examType_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }



    // Online Exam Type Store
    public function store($data)
    {
        $storeData = new OnlineExamType();

        $storeData->name = $data->name;
        $storeData->status = $data->status;
        $storeData->save();

        $result['success'] = true;
        return $result;
    }



    // Online Exam Type Update
    public function update($request, $onlineExamType)
    {
        // dd($religion);
        $updateData = OnlineExamType::find($onlineExamType->id);
        $updateData->name = $request->name;
        $updateData->status = $request->status;

        $updateData->save();

        if ($updateData) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Delete Religion
    public function destroy($data)
    {

        // dd($data);
        $del_data = OnlineExamType::find($data->id);

        if ($del_data) {
            $del_data->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
