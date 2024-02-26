<?php

namespace App\Http\Controllers\onlineExam;

use App\Http\Controllers\Controller;
use App\Http\Requests\onlineExam\QuestionBankRequest;
use App\Models\onlineExam\QuestionBank;
use App\Models\onlineExam\QuestionBankAnswer;
use App\Models\onlineExam\QuestionGroup;
use App\Services\onlineExam\QuestionBankService;
use Illuminate\Http\Request;

class QuestionBankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $res = new QuestionBankService();
            return $res->index($request);
        }
        return view('dashboard.onlineExam.questionBank.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groups = QuestionGroup::all();
        return view('dashboard.onlineExam.questionBank.create', [
            'groups' => $groups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionBankRequest $request)
    {
        // dd($request->all());
        $validateData = $request->validated();
        $questionBank = new QuestionBankService();
        $data = $questionBank->store($request);

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
    public function edit(Request $request, QuestionBank $questionBank)
    {
        // dd($questionBank);
        $data = QuestionBankAnswer::where('question_bank_id', $questionBank->id)->get();
        $groups = QuestionGroup::all();
        // dd($questionBank);
        return view('dashboard.onlineExam.questionBank.edit', [
            'edit_data' => $questionBank,
            'answers' => $data,
            'groups' => QuestionGroup::all(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionBankRequest $request, QuestionBank $questionBank)
    {
        // dd($questionBank->id);
        $validateData = $request->validated();
        $updateQuestionBank = new QuestionBankService();
        $data = $updateQuestionBank->update($request, $questionBank);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(QuestionBank $questionBank)
    {
        $deleteQuestionBank = new QuestionBankService();
        return $deleteQuestionBank->destroy($questionBank);
    }
}
