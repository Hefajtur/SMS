<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimeSchedule;
use App\Http\Requests\academic\TimeScheduleRequest;
use Illuminate\Support\Facades\Validator;
use App\Services\academic\TimeScheduleService;

class TimeScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $timeScheduleService= new TimeScheduleService();
            return ($timeScheduleService -> index());
                      
          }
        return view('dashboard.academic.timeSchedule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.academic.timeSchedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeScheduleRequest $request)
    {
        $validator = $request->validated();
        $timeScheduleService= new TimeScheduleService();
        return $timeScheduleService -> create($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimeSchedule $timeSchedule)
    {
        return view('dashboard.academic.timeSchedule.edit', [

            'timeSchedule' => $timeSchedule,
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimeScheduleRequest $request, TimeSchedule $timeSchedule)
    {
        $validator = $request->validated();
        $timeScheduleService= new TimeScheduleService();
        return $timeScheduleService -> update($request, $timeSchedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeSchedule $timeSchedule)
    {
        $timeScheduleService= new TimeScheduleService();
        return $timeScheduleService -> destroy($timeSchedule);
    }
}
