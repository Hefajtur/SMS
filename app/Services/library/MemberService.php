<?php

namespace App\Services\library;

use App\Models\Member;
use Yajra\DataTables\DataTables;

/**
 * Class MemberService.
 */
class MemberService
{
    private $data = [];

    public function index()
    {
        $data = Member::with('memberCategory', 'user', 'memberGender')->get();
        // dd($data);
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {

                if ($data->status == 1) {
                    return '<span class="badge_status_act">Active</span>';
                } else {
                    return '<span class="badge_status_inact">Inactive</span>';
                }
            })
            ->addColumn('name', function ($data) {

                return $data->user->name;
            })
            ->addColumn('member_cat_name', function ($data) {

                return $data->MemberCategory->member_cat_name;
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="member_edit" member_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="member_del" member_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'name', 'member_cat_name'])
            ->make();
    }



    // Create Member
    public function create($request)
    {
        // dd($request->all());
        $data = new Member();
        $data->user_id = $request->user_id;
        $data->member_category_id = $request->member_cat;
        $data->status = $request->status;
        $data->save();

        $result['success'] = true;
        return $result;
    }


    // Update Member
    public function update($request, $result)
    {
        // dd($request);
        $data = Member::find($result->id);
        $data->user_id = $request->user_id;
        $data->member_category_id = $request->member_cat;
        $data->status = $request->status;
        $data->phone = $request->member_phone;
        $data->email = $request->member_email;
        $data->gender = $request->member_gender;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Delete Member 
    public function delete($result)
    {

        $del_member = Member::find($result->id);

        if ($del_member) {
            $del_member->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
