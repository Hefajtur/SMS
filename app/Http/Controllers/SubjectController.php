<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\academic\SubjectRequest;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use App\Services\academic\SubjectService;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $subjectService= new SubjectService();
            return ($subjectService -> index());
                      
          }
        return view('dashboard.academic.subject.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.academic.subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        $validator = $request->validated();
        $subjectService= new SubjectService();
        return $subjectService -> create($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        return view('dashboard.academic.subject.edit', [

            'subject' => $subject,
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject)
    {

        $validator = $request->validated();
        $subjectService= new SubjectService();
        return $subjectService -> update($request, $subject);

       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subjectService= new SubjectService();
        return $subjectService -> destroy($subject);
    }
}
