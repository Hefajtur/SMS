<?php

namespace App\Http\Controllers\fees;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\fees\StoreGroupRequest;
use App\Services\fees\StoreGroupService;
use App\Models\Group;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $groupServices = new StoreGroupService();
            return $groupServices->index();
        }
        return view('dashboard.fees.group.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.fees.group.create');
 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        // dd($request->all());

        $groupServices = new StoreGroupService();
        return $groupServices->create($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        return view('dashboard.fees.group.edit', [
            'group' => $group,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGroupRequest $request, Group $group)
    {
        $validateData = $request->validated();
        $groupServices = new StoreGroupService();
        return $groupServices->update($request, $group);
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $groupServices = new StoreGroupService();
        return $groupServices->destroy($group);    
   
    }
}
