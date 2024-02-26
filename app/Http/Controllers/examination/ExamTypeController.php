<?php

namespace App\Http\Controllers\examination;

use App\Http\Controllers\Controller;
use App\Http\Requests\examination\ExamTypeRequest;
use App\Services\examination\ExamTypeService;
use Illuminate\Http\Request;
use App\Models\ExamType;
use Illuminate\Support\Facades\Validator;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $assignService = new ExamTypeService();
            return $assignService->index();
            // dd($abc);
        }
        return view('dashboard.examination.type.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.examination.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamTypeRequest $request)
    {
        $validateData = $request->validated();
        $assignService = new ExamTypeService();
        return $assignService->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamType $examType)
    { 
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamType $examtype)
    {
        return view('dashboard.examination.type.edit', [
            "examtypes" => $examtype
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExamTypeRequest $request, ExamType $examtype)
    {
        $validateData = $request->validated();
        $assignService = new ExamTypeService();
        return $assignService->update($request, $examtype);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamType $examtype)
    { 
        $assignService = new ExamTypeService();
        return $assignService->destroy($examtype);
    }

}
