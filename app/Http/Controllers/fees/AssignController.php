<?php

namespace App\Http\Controllers\fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\fees\AssignRequest;
use App\Models\Category;
use App\Models\Classes;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Group;
use App\Models\Assign;
use App\Models\Master;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Type;
use App\Models\AssignData;
use App\Models\StudentCategory;
use App\Services\fees\AssignService;
use Illuminate\Http\Request;
use DB;


class AssignController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $assignService = new AssignService();
            return $assignService->index();
        }
        return view('dashboard.fees.assign.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.fees.assign.create', [
            'groups' => Group::all(),
            'classes' => Classes::all(),
            'sections' => Section::all(),
            'students' => Student::all(),
            'genders' => Gender::all(),
            'StudentCategories' => StudentCategory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)   
    {
        // $validateData = $request->validated();
        $assignService = new AssignService();
        return $assignService->create($request);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $data = DB::table('assign_data')
        ->join('students', 'assign_data.students_id', '=', 'students.id')
        ->join('guardians', 'students.parent', '=', 'guardians.id')
        ->join('assigns', 'assign_data.assign_id', '=', 'assigns.id')
        ->join('classes', 'assigns.class_id', '=', 'classes.id')
        ->join('sections', 'assigns.section_id', '=', 'sections.id')
        ->join('masters', 'assign_data.master_id', '=', 'masters.id')
        ->join('types', 'masters.type_id', '=', 'types.id')
        ->where('assign_data.assign_id', $id)
        ->select(
            'students.admission_no',
            'students.first_name',
            'students.last_name',
            'students.mobile',
            'classes.name as class_name',
            'sections.name as section_name',
            'types.name as type_name',
            'guardians.guard_name as guard_name',
        )
        ->get();
    
        return response()->json($data);

    }


    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {

        $allDatas = Assign::join('assign_data', 'assigns.id', '=', 'assign_data.assign_id')
         ->join('masters', 'assign_data.master_id', '=', 'masters.id')
         ->join('types', 'masters.type_id', '=', 'types.id')
         ->where('assigns.id', $id)
         ->select('types.id as type_id', 'types.name as type_name')
         ->groupBy('types.id', 'types.name')
         ->get();

        // $allDatas = AssignData::with('masters')->get();

        $allStudents = Assign::join('assign_data', 'assigns.id', '=', 'assign_data.assign_id')
        ->join('students', 'assign_data.students_id', '=', 'students.id')
        ->join('classes', 'assigns.class_id', '=', 'classes.id')
        ->join('sections', 'students.section_id', '=', 'sections.id')
        ->join('guardians', 'students.parent', '=', 'guardians.id')
        ->where('assigns.id', $id)
        ->select(
            'students.*',
            'classes.name as class_name',
            'sections.name as section_name',
            'guardians.guard_name as guardians_name'
        )
        ->groupBy('students.first_name', 'students.last_name')
        ->get();
    

               
       $assigns = Assign::with('assigndata')
       ->find($id);

    //    dd($assigns);

    return view('dashboard.fees.assign.edit', [
        'types' => Type::all(),
        'assign' => $assigns,
        'allDatas' => $allDatas,
        'allStudents' => $allStudents,
        'groups' => Group::all(),
        'classes' => Classes::all(),
        'genders' => Gender::all(),
        'categories' => StudentCategory::all(),
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assign $assign)
    {
        // $validateData = $request->validated();
        $assignService = new AssignService();
        return $assignService->update($request, $assign);
    }

//destroy

    public function destroy(Assign $assign)
    {
        $assignService = new AssignService();
        return $assignService->destroy($assign);
    }


    //get master with type by group_id
    public function get_student_by_class_section_gender(Request $request)
    {
        $selectedClass = $request->class;
        $selectedSection = $request->section;
        $selectedGender = $request->gender;
        $selectedCategory = $request->category;
        $query = Student::when($selectedClass, function ($query, $selectedClass) {
            return $query->where('class_id', $selectedClass);
        })->when($selectedSection, function ($query, $selectedSection) {
            return $query->where('section_id', $selectedSection);
        })->when($selectedGender, function ($query, $selectedGender) {
            return $query->where('gender', $selectedGender);
        })->when($selectedCategory, function ($query, $selectedCategory) {
            return $query->where('category_id', $selectedCategory);
        })->with('class', 'section', 'guardians')->get();

        return $query;
    }
    /**
     * Remove the specified resource from storage.
     */

     public function get_master_by_groupId($id)
     {
         $masters = Master::where('group_id', $id)->with('types')->get();
         return $masters;
     }


     //get section

     public function getSectionforAssign($id)
    {
    $sectionAll = Section::where('class_id', $id)->get();
    $abc =$sectionAll->toArray();
    return $abc;
    }
 

}