<?php

namespace App\Services\onlineExam;

use App\Models\onlineExam\OnlineExam;
use App\Models\onlineExam\OnlineExamQstList;
use App\Models\onlineExam\OnlineExamQstStdList;
use App\Models\onlineExam\OnlineExamStdList;

/**
 * Class OnlineExamService.
 */
class OnlineExamService
{
    // Index data
    public function index()
    {
    }


    // Store data
    public function store($data)
    {
        // dd($request->all());
        $storeData = new OnlineExam();
        $storeData->name = $data->name;
        $storeData->start = $data->start;
        $storeData->end = $data->end;
        $storeData->published = $data->published;
        $storeData->question_group = $data->qstGroup;
        $storeData->class_id = $data->classes;
        $storeData->section_id = $data->section;
        $storeData->subject_id = $data->subject;
        $storeData->total_mark = $data->total_mark;
        $storeData->type_id = $data->type;
        $storeData->student_cat = $data->stdCat;
        $storeData->gender = $data->gender;

        $storeData->save();


        $explods = explode(',', $data->mycheckbox_item);
        // dd($explods);
        foreach ($data->qid as $key => $question) {
            // dd($data->qid);
            $questionListData = new OnlineExamQstList();
            $questionListData->online_exam_id = $storeData->id;
            $questionListData->question_bank_id = $question;
            $questionListData->status = $explods[$key];

            $questionListData->save();
        }

        if ($data->sid) {

            $explods_std = explode(',', $data->stdcheckbox_item);
            foreach ($data->sid as $key => $student) {
                // dd($student);
                $stdListData = new OnlineExamStdList();
                $stdListData->online_exam_id = $storeData->id;
                $stdListData->student_id = $student;
                $stdListData->status = $explods_std[$key];
    
                $stdListData->save();
            }
        }else {
            echo 'error';
        }

        $result['success'] = true;
        return $result;
    }






    // Update data
    public function update($request, $onlineExam)
    {
        // dd($onlineExam);
        $storeData = OnlineExam::find($onlineExam->id);
        $storeData->name = $request->name;
        $storeData->start = $request->start;
        $storeData->end = $request->end;
        $storeData->published = $request->published;
        $storeData->question_group = $request->qstGroup;
        $storeData->class_id = $request->classes;
        $storeData->section_id = $request->section;
        $storeData->subject_id = $request->subject;
        $storeData->total_mark = $request->total_mark;
        $storeData->type_id = $request->type;
        $storeData->student_cat = $request->stdCat;
        $storeData->gender = $request->gender;

        $storeData->save();



        // dd($request->mycheckbox_item);

        $explods = explode(',', $request->mycheckbox_item);
        // dd($explods);


        foreach ($request->qid as $key => $data) {

            $questionListData = OnlineExamQstList::where('question_bank_id', $request->qid[$key])->first();

            if ($questionListData <> NULL) {
                // dd($questionListData);
                $questionListData->question_bank_id = $data;
                $questionListData->status = $explods[$key];

                $questionListData->save();
            } else {
                $questionListData = new OnlineExamQstList();
                $questionListData->question_bank_id = $data;
                $questionListData->status = $explods[$key];

                $questionListData->save();
            }


            // $questionListData->question_bank_id = $data;
            // $questionListData->status = $explods[$key];

            // $questionListData->save();
        }


        if ($request->sid) {
            
            $explods_std = explode(',', $request->stdcheckbox_item);
            foreach ($request->sid as $key => $student) {

                $stdListData = OnlineExamStdList::where('student_id', $request->sid[$key])->first();
                // dd($stdListData);

                if ($stdListData <> NULL) {
                    $stdListData->student_id = $student;
                    $stdListData->status = $explods_std[$key];

                    $stdListData->save();
                } else {
                    $stdListData = new OnlineExamStdList();
                    $stdListData->online_exam_id = $storeData->id;
                    $stdListData->student_id = $student;
                    $stdListData->status = $explods_std[$key];

                    $stdListData->save();
                }
            }
        } else {
            
            $result['message'] = 'Oops..! Student select required';
            return $result;
        }

        $result['success'] = true;
        return $result;
    }


    // Destroy data
    public function destroy($questionBank)
    {
        $del_data = OnlineExam::find($questionBank->id);
        $qst_listData = OnlineExamQstList::where('online_exam_id', $questionBank->id);
        $std_list_Data = OnlineExamStdList::where('online_exam_id', $questionBank->id);
        // dd($data);

        if ($del_data && $qst_listData && $std_list_Data) {
            $del_data->delete();
            $qst_listData->delete();
            $std_list_Data->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
