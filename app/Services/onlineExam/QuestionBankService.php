<?php

namespace App\Services\onlineExam;

use App\Models\onlineExam\QuestionBank;
use App\Models\onlineExam\QuestionBankAnswer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

/**
 * Class QuestionBankService.
 */
class QuestionBankService
{
    // Question Bank Index
    public function index(Request $request)
    {
        $data = QuestionBank::with('questionGroup')->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('search_keyword'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['question_type']), Str::lower($request->get('search_keyword')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['question_type']), Str::lower($request->get('search_keyword')))) {
                            return true;
                        }

                        return false;
                    });
                }

                if (!empty($request->get('search'))) {
                    $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                        if (Str::contains(Str::lower($row['question']), Str::lower($request->get('search')))) {
                            return true;
                        } else if (Str::contains(Str::lower($row['question']), Str::lower($request->get('search')))) {
                            return true;
                        }

                        return false;
                    });
                }
            })
            ->addColumn('question_type', function ($data) {

                if ($data->question_type == 1) {

                    return 'Single Choice';
                } elseif ($data->question_type == 2) {

                    return 'Multiple Choice';
                } elseif ($data->question_type == 3) {

                    return 'True / False';
                }elseif ($data->question_type == 4) {

                    return 'Descriptive';
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
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="qstBank_edit" qstBank_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="qstBank_del" qstBank_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'question_type'])
            ->make(true);
    }


    // Question Bank store
    public function store($request)
    {
        // dd($request->all());
        $storeData = new QuestionBank();
        $storeData->question_type = $request->question_type;
        $storeData->question_group = $request->question_group;
        $storeData->status = $request->status;
        $storeData->mark = $request->mark;
        $storeData->question = $request->question;

        if ($request->question_type == 1) {

            $storeData->c_ans = $request->sc_answer;
        } elseif ($request->question_type == 2) {

            $storeData->c_ans = json_encode($request->mcq_answer);
        } elseif ($request->question_type == 3) {

            $storeData->c_ans = $request->trueFalseAnswer;
        }

        // elseif ($request->question_type == 4) {

        //     $storeData->c_ans = $request->trueFalseAnswer;
        // }

        $storeData->save();



        // Data for Single Choice Question ------------------------------------->
        if (isset($request->sc_singleOption)) {

            foreach ($request->sc_singleOption as $key => $option) {

                $optionData = new QuestionBankAnswer();
                $optionData->question_bank_id = $storeData->id;
                $optionData->total_option = $request->sc_total_option;
                $optionData->single_option = $option;
                $optionData->save();
            }
        }



        // Data for MCQ ------------------------------------->
        if (isset($request->mcq_SingleOption)) {

            foreach ($request->mcq_SingleOption as $key => $option) {

                $optionData = new QuestionBankAnswer();
                $optionData->question_bank_id = $storeData->id;
                $optionData->total_option = $request->mcq_total_option;
                $optionData->single_option = $option;
                $optionData->save();
            }
        }



        // Data for Ture / Flase ------------------------------------->
        if ($request->trueFalseAnswer == 0 || $request->trueFalseAnswer == 1) {

            $optionData = new QuestionBankAnswer();
            $optionData->question_bank_id = $storeData->id;
            $optionData->single_option = $request->trueFalseAnswer;
            $optionData->save();
        }



        $result['success'] = true;
        return $result;
    }
    // End Store ------------------------->







    // Question Bank update
    public function update($request, $questionBank)
    {

        $storeData = QuestionBank::find($questionBank->id);
        $storeData->question_type = $request->question_type;
        $storeData->question_group = $request->question_group;
        $storeData->status = $request->status;
        $storeData->mark = $request->mark;
        $storeData->question = $request->question;
        if ($request->question_type == 1) {

            $storeData->c_ans = $request->sc_answer;
        } elseif ($request->question_type == 2) {

            $storeData->c_ans = json_encode($request->mcq_answer);
        } elseif ($request->question_type == 3) {

            $storeData->c_ans = $request->trueFalseAnswer;
        }

        $storeData->save();



        // For Single Choice Question ------------------------------->
        if ($request->question_type == 1) {

            if (isset($request->sc_single_option)) {

                foreach ($request->sc_singleOption as $key => $option) {

                    $optionData = QuestionBankAnswer::where('id', $request->sc_single_option[$key])->first();


                    $optionData->question_bank_id = $storeData->id;
                    $optionData->total_option = $request->sc_total_option;
                    $optionData->single_option = $option;
                    $optionData->save();
                }
            } else {

                if ($request->has('qstBank_id')) {
                    $optionData = QuestionBankAnswer::where('question_bank_id', $request->qstBank_id)
                        ->delete();
                }

                foreach ($request->sc_singleOption as $key => $option) {

                    $optionData =  new QuestionBankAnswer();
                    $optionData->question_bank_id = $storeData->id;
                    $optionData->total_option = $request->sc_total_option;
                    $optionData->single_option = $option;
                    $optionData->save();
                }
            }
        }



        // For MCQ ------------------------------->
        if ($request->question_type == 2) {

            if (isset($request->mcq_single_option)) {

                foreach ($request->mcqSingleOption as $key => $option) {

                    $optionData = QuestionBankAnswer::where('id', $request->mcq_single_option[$key])->first();


                    $optionData->question_bank_id = $storeData->id;
                    $optionData->total_option = $request->mcqtotal_option;
                    $optionData->single_option = $option;
                    $optionData->save();
                }
            } else {

                if ($request->has('qstBank_id')) {
                    $optionData = QuestionBankAnswer::where('question_bank_id', $request->qstBank_id)
                        ->delete();
                }

                foreach ($request->mcqSingleOption as $key => $option) {

                    $optionData =  new QuestionBankAnswer();
                    $optionData->question_bank_id = $storeData->id;
                    $optionData->total_option = $request->mcqtotal_option;
                    $optionData->single_option = $option;
                    $optionData->save();
                }
            }
        }


        // Data for Ture / Flase ------------------------------------->
        if ($request->question_type == 3) {

            $optionData =  QuestionBankAnswer::where('question_bank_id', $request->qstBank_id)->first();

            $optionData->question_bank_id = $request->qstBank_id;
            $optionData->single_option = $request->trueFalseAnswer;
            $optionData->save();
        }


        $result['success'] = true;
        return $result;
    }






    // Question Bank destroy
    public function destroy($data)
    {
        $del_data = QuestionBank::find($data->id);

        if ($del_data) {
            $del_data->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
