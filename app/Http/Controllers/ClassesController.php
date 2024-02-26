<?php

namespace App\Http\Controllers;
use App\Http\Requests\academic\ClassRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Services\academic\ClassService;


class ClassesController extends Controller
{
    public $response = [];

    public function index(Request $request)
    {
        if($request->ajax()){
            $classService= new ClassService();
            return ($classService -> index());
                      
          }
        return view('dashboard.academic.class.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.academic.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRequest $request)
    {
        $validator = $request->validated();
        $classService= new ClassService();
        return $classService -> create($request); 

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classes $class)
    {
        return view('dashboard.academic.class.edit', [

            'classes' => $class,
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRequest $request, Classes $class)
    {
        $validator = $request->validated();
        $classService= new ClassService();
        return $classService -> update($request, $class); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classes $class)
    {

        $classService= new ClassService();
        return $classService -> destroy($class);

    }

    
}
