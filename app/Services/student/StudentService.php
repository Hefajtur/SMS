<?php

namespace App\Services\student;

use App\Models\Student;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Shift;
use App\Models\Guardian;
use App\Models\User;
use App\Models\StudentCategory;
use Illuminate\Support\Str;
use App\helper\FileUpload;
use App\Models\StudentDocument;
use Yajra\DataTables\DataTables;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
/**
 * Class StudentService.
 */
class StudentService
{
    public function index($request)
    {

    $data = Student::with('class', 'section', 'shift', 'category', 'bloods', 'religions', 'genders', 'guardians')->latest();

    // Filter by Class if selected
    if ($request->has('class_id')) {
    $data->where('class_id', $request->class_id);
    }

    // Filter by Section if selected
    if ($request->has('section_id')) {
    $data->where('section_id', $request->section_id);
    }

    // Filter by Keyword if entered
    if ($request->has('student_field')) {
    $keyword = $request->student_field;
    $data->where(function($query) use ($keyword) {
        $query->where('admission_no', 'LIKE', "%$keyword%")
              ->orWhere('roll_no', 'LIKE', "%$keyword%")
              ->orWhere('first_name', 'LIKE', "%$keyword%")
              ->orWhere('last_name', 'LIKE', "%$keyword%")
              ->orWhere('mobile', 'LIKE', "%$keyword%")
              ->orWhere('b_date', 'LIKE', "%$keyword%");
    });
}

    $data = $data->get();


        return DataTables::of($data)

            ->addIndexColumn()


            ->addColumn('studentName', function ($data) {

                return  '<a href="javascript:void(0)" id="student_show" student_id=" ' . $data->id . '"> <img src="' . $data->image . '" alt="" style="height: 60px; width: 60px">' . $data->first_name . ' ' . $data->last_name . '</a>';
            })

            ->addColumn('Class(Section)', function ($data) {
                return $data->class->name . '(' . $data->section->name . ')';
            })

            ->addColumn('gender', function ($data) {
                return $data->genders->name;
            })

            ->addColumn('parent', function ($data) {
                return $data->guardians->guard_name;
            })

            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    return "<span class='badge_status_act'> Active </span>";
                } else {
                    return "<span class='badge_status_inact'> Inactive </span>";
                }
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" id="student_edit"
                student_id="' . $data->id . '" class="btn btn-success btn-sm"><i class="fa-solid fa-pen-to-square"></i></a> <a href="javascript:void(0)" id="student_delete" student_id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'studentName', 'gender'])
            ->make(true);
    }


    public function create($request)
    {

        $student = new Student();
        $student->admission_no = $request->admission_no;
        $student->roll_no = $request->roll_no;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->mobile = $request->mobile;
        $student->email = $request->email;
        $student->class_id = $request->class_id;
        $student->section_id = $request->section_id;
        $student->shift_id = $request->shift_id;
        $student->b_date = $request->b_date;
        $student->religion = $request->religion;
        $student->gender = $request->gender;
        $student->category_id = $request->category_id;
        $student->blood = $request->blood;
        $student->admission_date = $request->admission_date;
        $student->image = FileUpload::imageUpload($request->file('image'), 'stu/');
        $student->parent = $request->parent;
        $student->status = $request->status;
        $student->session_id = $request->session_id;
        $student->save();

        // $user = new User();
        // $user->email = $request->email;
        // $user->password =  Hash::make($request->mobile);
        // $user->name = $request->first_name;
        // $user->role = 1;
        // $user->save();


        foreach ($request->doc_name as $key => $docnames) {
            $studentDocument = new StudentDocument();
            $studentDocument->student_id = $student->id;
            $studentDocument->doc_name = $docnames;
            $studentDocument->document = FileUpload::imageUpload($request->file('document')[$key], 'stu/');
            $studentDocument->save();
        }

        $this->response['success'] = true;
        return $this->response;
    }

    public function update($request)
    {

        $student = Student::find($request->id);
        $student->admission_no = $request->admission_no;
        $student->roll_no = $request->roll_no;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->mobile = $request->mobile;
        $student->email = $request->email;
        $student->class_id = $request->class_id;
        $student->section_id = $request->section_id;
        $student->shift_id = $request->shift_id;
        $student->b_date = $request->b_date;
        $student->religion = $request->religion;
        $student->gender = $request->gender;
        $student->category_id = $request->category_id;
        $student->blood = $request->blood;
        $student->admission_date = $request->admission_date;
        $student->image = FileUpload::imageUpload($request->file('image'), 'stu/', isset($student->id) ? Student::find($student->id)->image : null);
        $student->parent = $request->parent;
        $student->status = $request->status;
        $student->session_id = $request->session_id;
        $student->save();

        if ($request->has('doc_name') && $request->has('document')) {
            foreach ($request->input('doc_name') as $key => $docName) {
                if (isset($request->document[$key])) {
                    $studentDocument = new StudentDocument();
                    $studentDocument->student_id = $student->id;
                    $studentDocument->doc_name = $docName;
                    $studentDocument->document = FileUpload::imageUpload($request->file('document')[$key], 'stu/');
                    $studentDocument->save();
                }
            }
        }

        $this->response['success'] = true;
        return $this->response;
    }


    public function destroy($student)
    {
        $students = Student::find($student->id);

        $studentDocument = StudentDocument::where('student_id', $student->id)->get();
        foreach ($studentDocument as $key => $val) {
            if (file_exists($val->document)) {
                unlink($val->document);
            }
            $val->delete();
        }

        if (file_exists($students->image)) {
            unlink($students->image);
        }
        $students->delete();
        $this->response['success'] = true;
        return $this->response;
    }


    public function docDestroy($id)
    {

        $doc = StudentDocument::find($id);
        $doc->delete();

        $this->response['success'] = true;
        return $this->response;
    }
}
