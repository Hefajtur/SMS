<?php

namespace App\Http\Controllers\routine;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Shift;
use App\Models\Day;
use App\Models\Subject;
use App\Models\TimeSchedule;
use App\Models\ClassRoom;
use App\Models\ClassRoutine;
use App\Services\routine\ClassRoutineService;
use App\Http\Requests\routine\ClassRoutineRequest;

class ClassRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $classRoutineService= new ClassRoutineService();
            return ($classRoutineService -> index());
                      
        }
        return view('dashboard.routine.classroutine.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.routine.classroutine.create',
        [
            'classes'  => Classes::all(),
            'sections' => Section::all(),
            'subjects' => Subject::all(),
            'shifts' => Shift::all(),
            'days'  =>Day::all(),
            'timeschedules' => TimeSchedule::all(),
            'classrooms' => ClassRoom::all(),
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRoutineRequest $request)
    {
        $validator = $request->validated();
        $classRoutineService= new ClassRoutineService();
        return $classRoutineService -> create($request);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($class_id , $section_id)
    {
        $classRoutines = ClassRoutine::where('class_id', $class_id)->where('section_id', $section_id)->with('subject', 'timeschedule', 'classroom')->get();

        return view('dashboard.routine.classroutine.edit',
        [
            'classRoutines' => $classRoutines, 
            'classes'  => Classes::all(),
            'sections' => Section::all(),
            'subjects' => Subject::all(),
            'shifts' => Shift::all(),
            'days'  =>Day::all(),
            'timeschedules' => TimeSchedule::all(),
            'classrooms' => ClassRoom::all(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $class_id , $section_id)
    {
        // $validator = $request->validated();
        $classRoutineService= new ClassRoutineService();
        return $classRoutineService -> update($request, $class_id , $section_id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($class_id , $section_id)
    {
        $classRoutineService= new ClassRoutineService();
        return $classRoutineService -> destroy($class_id , $section_id);
    }


    //class with section
    public function section($id)
    {
    $sectionAll = Section::where('class_id', $id)->get();
    $abc =$sectionAll->toArray();
    return $abc;
    }
}
