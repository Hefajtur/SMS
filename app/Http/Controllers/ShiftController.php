<?php

namespace App\Http\Controllers;
use App\Models\Shift;
use Illuminate\Http\Request;
use App\Http\Requests\academic\ShiftRequest;
use Illuminate\Support\Facades\Validator;
use App\Services\academic\ShiftService;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $shiftService= new ShiftService();
            return ($shiftService -> index());
                      
          }
        return view('dashboard.academic.shift.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.academic.shift.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShiftRequest $request)
    {
        $validator = $request->validated();
        $shiftService= new ShiftService();
        return $shiftService -> create($request);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shift $shift)
    {
        return view('dashboard.academic.shift.edit', [

            'Shift' => $shift,
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShiftRequest $request, Shift $shift)
    {
        $validator = $request->validated();
        $shiftService= new ShiftService();
        return $shiftService -> update($request, $shift);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        $shiftService= new ShiftService();
        return $shiftService -> destroy($shift);
    }
}
