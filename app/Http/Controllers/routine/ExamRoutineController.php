<?php

namespace App\Http\Controllers\routine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\routine\ExamRoutineService;
use App\Models\Subject;
use App\Models\TimeSchedule;
use App\Models\ClassRoom;
use App\Models\Classes;
use App\Models\Section;
use App\Models\ExamRoutine;
use App\Models\ExamType;
use App\Http\Requests\routine\ExamRoutineRequest;

class ExamRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $examRoutineService= new ExamRoutineService();
            return ($examRoutineService -> index());
                      
        }
        return view('dashboard.routine.examroutine.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.routine.examroutine.create',
        [
            'classes'  => Classes::all(),
            'sections' => Section::all(),
            'subjects' => Subject::all(),
            'timeschedules' => TimeSchedule::all(),
            'classrooms' => ClassRoom::all(),
            'examTypes' => ExamType::all(),
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamRoutineRequest $request)
    {
        $validator = $request->validated();
        $examRoutineService= new ExamRoutineService();
        return $examRoutineService -> create($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($class_id , $section_id)
    {
        $examRoutines = ExamRoutine::where('class_id', $class_id)->where('section_id', $section_id)->with('subject', 'timeschedule', 'classroom')->get();

        return view('dashboard.routine.examroutine.edit',
        [
            'examRoutines' => $examRoutines, 
            'classes'  => Classes::all(),
            'sections' => Section::all(),
            'subjects' => Subject::all(),
            'timeschedules' => TimeSchedule::all(),
            'classrooms' => ClassRoom::all(),
            'examTypes' => ExamType::all(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $class_id , $section_id)
    {
        $examRoutineService= new ExamRoutineService();
        return $examRoutineService -> update($request, $class_id , $section_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($class_id , $section_id)
    {
        $examRoutineService= new ExamRoutineService();
        return $examRoutineService -> destroy($class_id , $section_id);
    }

     //class with section
     public function section($id)
     {
     $sectionAll = Section::where('class_id', $id)->get();
     $abc =$sectionAll->toArray();
     return $abc;
     }
}
