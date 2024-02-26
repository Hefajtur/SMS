<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\academic\SubjectAssignRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\User;
use App\Models\SubjectAssign;
use App\Services\academic\SubjectAssignService;

class SubjectAssignController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $subjectAssignService= new SubjectAssignService();
            return ($subjectAssignService -> index());
                      
        }
        return view('dashboard.academic.subjectAssign.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.academic.subjectAssign.create',
        [
            'classes'  => Classes::all(),
            'sections' => Section::all(),
            'subjects' => Subject::all(),
            'users' => User::where('role', 3)->get(),
        ]);
    }

    //modal show with subject and teacher data
    public function show($id)
    {
        $subjectAssignService= new SubjectAssignService();
        return $subjectAssignService -> modalShow($id);     
 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectAssignRequest $request)
    {

        $validator = $request->validated();
        $subjectAssignService= new SubjectAssignService();
        return $subjectAssignService -> create($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($class_id , $section_id)
    {
     
        $subjectAssigns = SubjectAssign::where('class_id', $class_id)->where('section_id', $section_id)->with('subject', 'user')->get();

        // echo "<pre>";
        // print_r($subjectAssigns);
        // die;
        return view('dashboard.academic.subjectAssign.edit',
        [
            'subjectAssigns' => $subjectAssigns, 
            'classes'  => Classes::all(),
            'sections' => Section::all(),
            'subjects' => Subject::all(),
            'users' => User::where('role', 3)->get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectAssignRequest $request, $class_id , $section_id)
    {
        $validator = $request->validated();
        $subjectAssignService= new SubjectAssignService();
        return $subjectAssignService -> update($request, $class_id , $section_id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($class_id , $section_id)
    {
        $subjectAssignService= new SubjectAssignService();
        return $subjectAssignService -> destroy($class_id , $section_id);
    }

        //class with section
   public function section($id)
   {
    $sectionAll = Section::where('class_id', $id)->get();
    $abc =$sectionAll->toArray();
    return $abc;
   }
}
