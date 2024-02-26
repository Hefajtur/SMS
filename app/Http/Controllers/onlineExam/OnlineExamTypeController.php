<?php

namespace App\Http\Controllers\onlineExam;

use App\Http\Controllers\Controller;
use App\Http\Requests\onlineExam\OnlineExamTypeRequest;
use App\Models\onlineExam\OnlineExamType;
use App\Services\onlineExam\OnlineExamTypeService;
use Illuminate\Http\Request;

class OnlineExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $res = new OnlineExamTypeService();
            return $res->index();
        }
        return view('dashboard.onlineExam.type.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.onlineExam.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OnlineExamTypeRequest $request)
    {
        $validateData = $request->validated();
        $onlineExamType = new OnlineExamTypeService();
        $data = $onlineExamType->store($request);

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OnlineExamType $onlineExamType)
    {
        return view('dashboard.onlineExam.type.edit', [
            'edit_data' => $onlineExamType,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OnlineExamTypeRequest $request, OnlineExamType $onlineExamType)
    {
        // dd($onlineExamType->id);
        $validateData = $request->validated();
        $updateOnlineExamType = new OnlineExamTypeService();
        $data = $updateOnlineExamType->update($request, $onlineExamType);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    // Delete Religion Data
    public function destroy(OnlineExamType $onlineExamType)
    {
        // dd($onlineExamType);
        $deleteOnlineExamType = new OnlineExamTypeService();
        return $deleteOnlineExamType->destroy($onlineExamType);
    }
}
