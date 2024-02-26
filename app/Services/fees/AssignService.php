<?php

namespace App\Services\fees;

use App\Models\Assign;
use App\Models\AssignData;
use Yajra\DataTables\DataTables;

/**
 * Class AssignService.
 */
class AssignService
{
    public function index()
    {
        $assigns = Assign::with('group', 'class', 'section', 'category', 'genders')->get();

        return DataTables::of($assigns)
            ->addIndexColumn()

            ->addColumn('class(section)', function ($assigns) {
               return $assigns->class->name . '('. $assigns->section->name .')';
            })

            ->addColumn('category', function ($assigns) {
                if($assigns->category_id == Null){
                    return NULL;
                }
                else{
                    return $assigns->category->name;
                }
             })

             ->addColumn('gender', function ($assigns) {
                if($assigns->gender == Null){
                    return NULL;
                }
                else{
                    return $assigns->genders->name;
                }
             })

            ->addColumn('students', function ($assigns) {
                $student = '<a href="javascript:void(0)" id="show-students" data_url=" '.$assigns->id. '" class="bg-warning border border-light rounded-circle p-2 text-white"><i class="fa-solid fa-eye"></i></a>';
                return $student;
            })
            ->addColumn('action', function ($assigns) {
                $actionBtn = '<a href="" id="assign_edit" assign_id="'.$assigns->id.'" class="edit btn btn-success btn-sm">Edit</a> <a href="" id="assign_delete" assign_id="' . $assigns->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })

            ->rawColumns(['action', 'status', 'students'])
            ->make(true);
    }


    
    public function create($request)
    {
        // dd($request);
            $assign = new Assign();
            $assign->group_id = $request['group_id'];
            $assign->class_id = $request['class_id'];
            $assign->section_id = $request['section_id'];
            $assign->gender = $request['gender'];
            $assign->category_id = $request['category_id'];
                                
            $assign->save();
        

        foreach ($request->master_id as $key => $masters) {
            foreach($request->students_id as $student ){
            $assignData = new AssignData();
            $assignData->assign_id = $assign->id;
            $assignData->master_id = $masters;
            
            $assignData->students_id = $student;

            $assignData->save();
            }
        }

        $data['success'] = true;
        return $data;
    }


      public function update($request, $assign)
    {
    $assign = Assign::find($assign->id);
    $assign->group_id = $request->input('group_id');
    $assign->class_id = $request->input('class_id');
    $assign->section_id = $request->input('section_id');
    $assign->gender = $request->input('gender');
    $assign->category_id = $request->input('category_id');    
    $assign->save();

    // Clear existing AssignData records for this assignment
    AssignData::where('assign_id', $assign->id)->delete();

    foreach ($request->input('master_id') as $masterId) {
        foreach ($request->input('students_id') as $studentId) {
            $assignData = new AssignData();
            $assignData->assign_id = $assign->id;
            $assignData->master_id = $masterId;
            $assignData->students_id = $studentId;
            $assignData->save();
        }
    }

    $data['success'] = true;
    return $data;
}

    

    
    public function destroy($assign)
    {
        $assign = Assign::find($assign->id);
        $assigndata = AssignData::where('assign_id', $assign->id)->get();

        foreach ($assigndata as $key => $val) {
            $val->delete();
        }

        $assign->delete();
        $response['success'] = true;
        return $response;
    }

}