<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\gardianStoreRequest;
use App\Models\Guardian;
use App\Services\GardianService;

class GaurdianController extends Controller
{
    public $response = [];

    public function index(Request $request)
    {
        if($request->ajax()){
          $gardianService= new GardianService();
          return ($gardianService -> index());
                    
        }
        return view('dashboard.student_info.gaurdians.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.student_info.gaurdians.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(gardianStoreRequest $request)
    {
        $validateData = $request->validated();
        $gardianService= new GardianService();
        return $gardianService -> create($request);

    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {

        $gaurdian = Guardian::find($id);

        return view('dashboard.student_info.gaurdians.edit', [

            'guardians' => $gaurdian,
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(gardianStoreRequest $request)
    {
        $validateData = $request->validated();
        $gardianService= new GardianService();
        return $gardianService -> update($request);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gardianService= new GardianService();
        return $gardianService -> destroy($id);
    }
}
