<?php

namespace App\Http\Controllers\examination;

use App\Http\Controllers\Controller;
use App\Models\ExamSettings;
use App\Models\PassMark;
use App\Models\MarkGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarkGradeController extends Controller
{
    public function index(Request $request)
    {
        $marks = MarkGrade::paginate(5);
        if ($request->ajax()) {
            return view('dashboard.examination.marks_grade.indexResult', compact('marks'));
        }
        return view('dashboard.examination.marks_grade.index', compact('marks'));

    }

    public function create()
    {
        return view('dashboard.examination.marks_grade.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'point' => 'required|max:255',
            'parcent_from' => 'required|max:255',
            'parcent_upto' => 'required|max:255',
            'remarks' => 'required|max:255',
            'status' => 'required'
        ]);

        if($validator->passes()) {
            $marks = new MarkGrade();
            $marks->name = $request['name'];
            $marks->point = $request['point'];
            $marks->parcent_from = $request['parcent_from'];
            $marks->parcent_upto = $request['parcent_upto'];
            $marks->remarks = $request['remarks'];
            $marks->status = $request['status'];
            $marks->save();
            $data['success'] = true;
            return $data;
        }else {
            $errors = $validator->errors();
            $data['errors'] = $errors;
            return json_encode($data);

        }
    }

    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        return view('dashboard.examination.marks_grade.edit', [
            'marks_grade' => MarkGrade::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'point' => 'required|max:255',
            'parcent_from' => 'required|max:255',
            'parcent_upto' => 'required|max:255',
            'remarks' => 'required|max:255',
            'status' => 'required'
        ]);

        if ($validator->passes()) {
            $marks = MarkGrade::find($id);
            $marks->name = $request->name;
            $marks->point = $request->point;
            $marks->parcent_from = $request->parcent_from;
            $marks->parcent_upto = $request->parcent_upto;
            $marks->remarks = $request->remarks;
            $marks->status = $request->status;
            $marks->save();
            $data['success'] = true;
            return $data;
        } else {
            $errors = $validator->errors();
            $data['errors'] = $errors;
            return json_encode($data);
        }
    }

     public function destroy(string $id)
    {
        if (!empty($id)) {
            $marks = MarkGrade::find($id);
            $marks->delete();
            $data['success'] = true;
            return $data;
        } else {
            $data['success'] = false;
            return $data;
        }
    }

    //settings
    public function passMarkShow()
    {
        return view('dashboard.examination.settings.index', [
            'avg_pass' => ExamSettings::first()
        ]);
    }
    public function passMarkStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avg_pass' => 'required',
        ]);
        if ($validator->passes()) {
            $marks = ExamSettings::find($request->id);
            $marks->avg_pass = $request->avg_pass;
            $marks->save();
            $data['success'] = true;
            return $data;
        } else {
            $errors = $validator->errors();
            $data['errors'] = $errors;
            return json_encode($data);
        }
    }
}