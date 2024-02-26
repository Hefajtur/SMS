<?php

namespace App\Services\library;

use App\Models\library\BookCategory;
use App\Models\library\MemberCategory;
use Yajra\DataTables\DataTables;

/**
 * Class MemberCategoryService.
 */
class MemberCategoryService
{
    private $data = [];

    public function index()
    {
        $data = MemberCategory::latest()->get();
       
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
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="memberCat_edit" memberCat_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i> Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="memberCat_del" memberCat_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i> Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }



    // Create Member Category
    public function create($request)
    {

        $data = new MemberCategory();

        $data->member_cat_name = $request->member_cat_name;
        $data->status = $request->status;
        $data->save();

        $result['success'] = true;
        return $result;
    }



    // Update Member Category
    public function update($request, $result)
    {
        $data = MemberCategory::find($result->id);

        $data->member_cat_name = $request->member_cat_name;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Delete Member Category
    public function delete($memberCat)
    {

        // dd($memberCat);
        $del_memberCat = MemberCategory::find($memberCat->id);

        if ($del_memberCat) {
            $del_memberCat->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
