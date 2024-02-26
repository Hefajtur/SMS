<?php

namespace App\Services\staff;

use App\helper\FileUpload;
use App\Models\document\Document;
use App\Models\StudentDocument;
use App\Models\Userstaff;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\DataTables;

/**
 * Class StaffService.
 */
class StaffService
{
    // Staff Index
    public function index()
    {
        $data = Userstaff::with('roles', 'departments', 'designations')->get();
        return DataTables::of($data)

            ->addIndexColumn()
            ->addColumn('name', function ($data) {
                $image_path = URL::to('/');

                return  '<img src="' . $image_path . '/' . $data->image . '" alt="" class="img-fluid rounded-circle" style="height: 60px; width: 60px">' . ' ' . $data->first_name . ' ' . $data->last_name;
            })
            ->addColumn('status', function ($data) {

                if ($data->status == 1) {
                    return '<span class="badge_status_act">Active</span>';
                } else {
                    return '<span class="badge_status_inact">Inactive</span>';
                }
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="staff_edit" staff_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="staff_del" staff_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['status', 'action', 'name'])
            ->make();
    }




    // Staff Create
    public function create($request)
    {

        // dd($request->staff_doc_name);

        $staff_data = new UserStaff();
        $staff_data->staffID = $request->staffID;
        $staff_data->role_id = $request->role_id;
        $staff_data->designation_id = $request->designation_id;
        $staff_data->department_id = $request->department_id;
        $staff_data->first_name = $request->first_name;
        $staff_data->last_name = $request->last_name;
        $staff_data->father_name = $request->father_name;
        $staff_data->mother_name = $request->mother_name;
        $staff_data->email = $request->email;
        $staff_data->gender = $request->gender;
        $staff_data->dob = $request->dob;
        $staff_data->join_date = $request->join_date;
        $staff_data->phone = $request->phone;
        $staff_data->emergency_contact = $request->emergency_contact;
        $staff_data->marital_status = $request->marital_status;
        $staff_data->status = $request->status;
        $staff_data->image = FileUpload::imageUpload($request->file('image'), 'staff/');
        $staff_data->current_add = $request->current_add;
        $staff_data->permanent_add = $request->permanent_add;
        $staff_data->status = $request->status;
        $staff_data->basic_salary = $request->basic_salary;

        $staff_data->save();


        if ($request->staff_doc_name) {

            foreach ($request->staff_doc_name as $key => $docs) {

                $doc_data = new Document();
                $doc_data->doc_id = $staff_data->id;
                $doc_data->doc_name = $docs;
                $doc_data->doc_item = FileUpload::imageUpload($request->file('staff_doc_img')[$key], 'documents/');
                $doc_data->save();
            }
        }

        if ($staff_data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Update Staff
    public function update($request, $id)
    {
        //  dd($id);
        $staff_data = Userstaff::find($request->id);
        $staff_data->staffID = $request->staffID;
        $staff_data->role_id = $request->role_id;
        $staff_data->designation_id = $request->designation_id;
        $staff_data->department_id = $request->department_id;
        $staff_data->first_name = $request->first_name;
        $staff_data->last_name = $request->last_name;
        $staff_data->father_name = $request->father_name;
        $staff_data->mother_name = $request->mother_name;
        $staff_data->email = $request->email;
        $staff_data->gender = $request->gender;
        $staff_data->dob = $request->dob;
        $staff_data->join_date = $request->join_date;
        $staff_data->phone = $request->phone;
        $staff_data->emergency_contact = $request->emergency_contact;
        $staff_data->marital_status = $request->marital_status;
        $staff_data->status = $request->status;
        $staff_data->image = FileUpload::imageUpload($request->file('image'), 'staff/');
        $staff_data->current_add = $request->current_add;
        $staff_data->permanent_add = $request->permanent_add;
        $staff_data->status = $request->status;
        $staff_data->basic_salary = $request->basic_salary;
        $staff_data->save();

        $rr = $request->row_id;

        if ($request->has('doc_name') || $request->has('document')) {
            // $rr = $row_id[$keys]
            foreach ($request->input('doc_name') as $key => $docName) {

                if (isset($request->document[$key])) {
                    $doc_data = new Document();
                    $doc_data->doc_id = $staff_data->id;
                    $doc_data->doc_name = $docName;
                    $doc_data->doc_item = FileUpload::imageUpload($request->file('document')[$key], 'staff/');
                    $doc_data->save();
                } else {

                    $doc_data = Document::where('id', $request->row_id[$key])->first();
                    // dd($doc_data);
                    $doc_data->doc_id = $staff_data->id;
                    $doc_data->doc_name = $docName;

                    // if (isset($request->document[$key])) {
                    //     $doc_data->doc_item = FileUpload::imageUpload($request->file('document')[$key], 'staff/');
                    // }
                    $doc_data->save();
                }
            }
        }

        $response['success'] = true;
        return $response;
    }



    // Document Delete
    public function docDestroy($id)
    {

        $doc = Document::find($id);
        $doc->delete();

        $response['success'] = true;
        return $response;
    }


    // Delete Staff
    public function delete($id)
    {
        // dd($id);
        $del_staff = UserStaff::find($id);

        if ($del_staff) {
            $data = $del_staff->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
