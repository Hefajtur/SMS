<?php

namespace App\Services;

use App\Models\SchoolSession;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

/**
 * Class SessionService.
 */
class SessionService
{
    public function index()
    {
        $data = SchoolSession::all();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {

                if ($data->status == 1) {
                    return '<span class="badge_status_act">Active</span>';
                } else {
                    return '<span class="badge_status_inact">Inactive</span>';
                }
            })
            ->addColumn('start_date', function ($data) {

                return Carbon::parse($data->start_date)->format('d M Y');
            })
            ->addColumn('end_date', function ($data) {

                return Carbon::parse($data->end_date)->format('d M Y');
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="session_edit" session_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i> Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="session_del" session_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i> Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'start_date', 'end_date'])
            ->make();
    }




    // Create Session
    public function create($request)
    {
        $data = new SchoolSession();
        $data->name = $request->name;
        $data->status = $request->status;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }




    // Update Session
    public function update($request, $sessionData)
    {

        // dd($session);
        $data = SchoolSession::find($sessionData->id);
        $data->name = $request->name;
        $data->status = $request->status;
        $data->start_date = $request->start_date;
        $data->end_date = $request->end_date;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Delete Session
    public function delete($schoolSession)
    {
        $del_schoolSession = SchoolSession::find($schoolSession->id);

        if ($del_schoolSession) {
            $del_schoolSession->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
