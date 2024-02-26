<?php

namespace App\Http\Controllers\fees;

use App\Http\Controllers\Controller;
use App\Models\Master;
use App\Models\Assign;
use App\Models\AssignData;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Models\Type;
use App\Models\ModalFeeCollection;
use Illuminate\Http\Request;
use App\Services\fees\FeesCollectService;
use DB;

class CollectFeesController extends Controller
{
//Index
    public function index()
    {
        return view('dashboard.fees.collect.index', [
            'classes' => Classes::all(),
            'students' => Student::all(),
        ]);
    }


    public function feesData(Request $request){

        $class = $request->class;
        $section = $request->section;
        $student = $request->student;

    $query = DB::table('students')
        ->join('assign_data', 'students.id', '=', 'assign_data.students_id')
        ->join('classes', 'students.class_id', '=', 'classes.id')
        ->join('sections', 'students.section_id', '=', 'sections.id')
        ->join('guardians', 'students.parent', '=', 'guardians.id')
        ->where('students.class_id', $class)
        ->where('students.section_id', $section)
        ->select('students.*', 'classes.name as class_name', 'sections.name as section_name', 'guardians.guard_name as guardian_name');

    if (!empty($student)) {
      //if a student is selected
        $query->where('assign_data.students_id', $student);
    }

    $data = $query->distinct()->get();

        return response()->json($data);

    }

//show 

    public function show($id)
    {
        $assignData  = AssignData::with('students', 'assign', 'masters')->where('students_id', $id)->get();

        // dd($assignData);
        return view('dashboard.fees.collect.show', [
            'assigns' =>  $assignData,
        ]);
    }


    //show data in modal
 
    public function showDataModal(Request $request) {
        
        $selectedData = $request->input('selectedData');

        $result = [];
    
        foreach ($selectedData as $data) {
            $group_id = $data['group_id'];
            $type_id = $data['type_id'];
            $student_id = $data['student_id'];
            $master_id = $data['master_id'];
            $assign_id = $data['assign_id'];

        $data = DB::table('masters')
        ->join('types', 'masters.type_id', '=', 'types.id')
        ->join('groups', 'masters.group_id', '=', 'groups.id')
        ->where('masters.type_id', $type_id )
        ->where('masters.group_id', $group_id ) 
        ->select('masters.*', 'types.name as type_name', 'groups.name as group_name')
        ->get();

         // Add student_id to the response data
         foreach ($data as $item) {
            $item->student_id = $student_id;
            $item->master_id = $master_id;
            $item->assign_id = $assign_id;
        }
            $result[] = $data;
        }
    
        return response()->json($result);
    }
    

    //colect fee from modal
    public function CollectFeeFromModal(Request $request){

        foreach($request->assign_id as $val) {

            $data = AssignData::where('students_id', $request->students_id)
            ->where('id', $val)
            ->update(['status' => 1]);
    
        }

    foreach ($request->amounts as $key => $amount) {
        $modalFeeCollection = new ModalFeeCollection();
        $modalFeeCollection->due_date = $request->due_date;
        $modalFeeCollection->payment = $request->payment;
        $modalFeeCollection->students_id = $request->students_id;
        $modalFeeCollection->amounts = $amount;
        $modalFeeCollection->fine_amounts = $request->fine_amounts[$key];
        $modalFeeCollection->save();
    }

        $this->response['success'] = true;
        return $this->response;

    }

    //Revert Status

    public function revertStatus($id){

        $data = AssignData::where('id', $id)->update(['status' => 0]);

        $this->response['success'] = true;
        return $this->response;

    }




    //get Section 
    public function getclassAndsection(Request $request)
    {
        $classId = $request->input('class_id');

        $sections = Section::where('class_id', $classId)->get();

        return response()->json($sections);
    }


    // Method to get students based on class and section selection
    public function getStudents(Request $request)
    {
        $classId = $request->input('class_id');
        $sectionId = $request->input('section_id');

        $students = Student::where('class_id', $classId)
            ->where('section_id', $sectionId)
            ->get();

        return response()->json($students);
    }


}