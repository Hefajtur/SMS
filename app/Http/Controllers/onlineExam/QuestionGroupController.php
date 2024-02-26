<?php

namespace App\Http\Controllers\onlineExam;

use App\Http\Controllers\Controller;
use App\Http\Requests\onlineExam\QuestionGroupRequest;
use App\Models\onlineExam\QuestionGroup;
use App\Services\onlineExam\QuestionGroupService;
use Illuminate\Http\Request;

class QuestionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $res = new QuestionGroupService();
            return $res->index($request);
        }
        return view('dashboard.onlineExam.questionGroup.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.onlineExam.questionGroup.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionGroupRequest $request)
    {
        $validateData = $request->validated();
        $questionGroup = new QuestionGroupService();
        $data = $questionGroup->store($request);

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
    public function edit(QuestionGroup $questionGroup)
    {
        return view('dashboard.onlineExam.questionGroup.edit', [
            'edit_data' => $questionGroup,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionGroupRequest $request, QuestionGroup $questionGroup)
    {
        // dd($questionGroup->id);
        $validateData = $request->validated();
        $updateQuestionGroup = new QuestionGroupService();
        $data = $updateQuestionGroup->update($request, $questionGroup);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    // Delete Religion Data
    public function destroy(QuestionGroup $questionGroup)
    {
        // dd($questionGroup);
        $deleteQuestionGroup = new QuestionGroupService();
        return $deleteQuestionGroup->destroy($questionGroup);
    }
}
