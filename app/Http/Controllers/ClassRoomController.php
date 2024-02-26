<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\academic\ClassRoomRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\ClassRoom;
use App\Services\academic\ClassRoomService;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $classRoomService= new ClassRoomService();
            return ($classRoomService -> index());
                      
          }
        return view('dashboard.academic.classRoom.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.academic.classRoom.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRoomRequest $request)
    {
        $validator = $request->validated();
        $classRoomService= new ClassRoomService();
        return $classRoomService -> create($request);

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $classRoom)
    {
        return view('dashboard.academic.classRoom.edit', [

            'classRoom' => $classRoom,
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRoomRequest $request, ClassRoom $classRoom)
    {
        $validator = $request->validated();
        $classRoomService= new ClassRoomService();
        return $classRoomService -> update($request, $classRoom);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $classRoom)
    {
        $classRoomService= new ClassRoomService();
        return $classRoomService -> destroy($classRoom);
    }
}
