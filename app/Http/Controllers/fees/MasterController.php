<?php

namespace App\Http\Controllers\fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\fees\MasterRequest;
use App\Services\fees\MasterService;
use Illuminate\Http\Request;
use App\Models\Master;
use App\Models\Group;
use App\Models\Type;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $masterService = new MasterService();
            // $data = $masterService->index();
            // dd($data);
            return $masterService->index();
        }
        return view('dashboard.fees.master.index');
    }
    
    // public function get_master_by_groupId($id)
    // {
    //     $masters = Master::where('group_id', $id)->with('types')->get();
    //     return $masters;
    // }


    public function create()
    {
        return view('dashboard.fees.master.create', [
            'groups' => Group::all(),
            'types' => Type::all(),

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MasterRequest $request)
    {
        $validateData = $request->validated();
        $masterService = new MasterService();
        return $masterService->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        // $master = Master::with('group', 'type')->get();
        // return response()->json(['success' => $master]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( Master $master)
    {
        $masterService = new MasterService();
        $data= $masterService->edit($master);
        return view('dashboard.fees.master.edit', [
            'master' => $data,
            'groups' => Group::all(),
            'types' => Type::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MasterRequest $request, Master $master)
    {
        $validateData = $request->validated();
        $masterService = new MasterService();
        return $masterService->update($request, $master);
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Master $master)
    {
       
        $masterService = new MasterService();
        return $masterService->destroy($master);  
        // $master = Master::find($id);
        // if ($master) {
        //     $master->delete();
        //     return $data['success'] = true;
        // } else {
        //     return $data['success'] = false;
        // }
    }



}