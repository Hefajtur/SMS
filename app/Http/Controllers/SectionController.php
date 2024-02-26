<?php

namespace App\Http\Controllers;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Section;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Services\academic\SectionService;
use App\Http\Requests\academic\SectionRequest;

class SectionController extends Controller
{
    public $response = [];

    public function index(Request $request)
    {
        if($request->ajax()){
            $sectionService= new SectionService();
            return ($sectionService -> index());
                      
        }
        return view('dashboard.academic.section.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.academic.section.create',
    [
        'classes'  => Classes::all(),
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectionRequest $request)
    {
        // $class_id = Section::where('class_id', $request->class_id)->where('name', $request->name)->get();

            $validator = $request->validated();
            $sectionService= new SectionService();
            return $sectionService -> create($request);             

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        return view('dashboard.academic.section.edit', [

            'section' => $section,
            'classes'  => Classes::all(),
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectionRequest $request, string $id)
    {
        // $class_id = Section::where('class_id', $request->class_id)->where('name', $request->name)->get();

        // if(count($class_id) < 1){

            $validator = $request->validated();
            $sectionService= new SectionService();
            return $sectionService -> update($request, $id); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $sectionService= new SectionService();
        return $sectionService -> destroy($section);

    }

//class with section
//    public function section($id)
//    {
//     $sectionAll = Section::where('class_id', $id)->get();
//     $abc =$sectionAll->toArray();
//     return $abc;
//    }


}
