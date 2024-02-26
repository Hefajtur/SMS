<?php

namespace App\Services\onlineExam;

use App\Models\onlineExam\QuestionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str; 
use Yajra\DataTables\DataTables;

/**
 * Class QuestionGroupService.
 */
class QuestionGroupService
{
    // Online Question Group Index
    public function index(Request $request)
    {
        $data = QuestionGroup::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('search_name'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search_name')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search_name')))) {
                            return true;
                        }

                        return false;
                    });
                }

                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                            return true;
                        }

                        return false;
                    });
                }
            })
            ->addColumn('status', function ($data) {

                if ($data->status == 1) {
                    return '<span class="badge_status_act">Active</span>';
                } else {
                    return '<span class="badge_status_inact">Inactive</span>';
                }
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="qstGroup_edit" qstGroup_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="qstGroup_del" qstGroup_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }



    // Online Question Group Store
    public function store($data)
    {
        $storeData = new QuestionGroup();

        $storeData->name = $data->name;
        $storeData->status = $data->status;
        $storeData->save();

        $result['success'] = true;
        return $result;
    }



    // Question Group Update
    public function update($request, $questionGroup)
    {
        // dd($questionGroup);
        $updateData = QuestionGroup::find($questionGroup->id);
        $updateData->name = $request->name;
        $updateData->status = $request->status;

        $updateData->save();

        if ($updateData) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Delete Question Group
    public function destroy($data)
    {

        // dd($data);
        $del_data = QuestionGroup::find($data->id);

        if ($del_data) {
            $del_data->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
