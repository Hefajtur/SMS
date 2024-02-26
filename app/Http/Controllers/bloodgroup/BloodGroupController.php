<?php

namespace App\Http\Controllers\bloodgroup;

use App\Http\Controllers\Controller;
use App\Http\Requests\setting\BloodGroupRequest;
use App\Models\BloodGroup;
use Illuminate\Http\Request;
use App\Services\BloodGroupService;


class BloodGroupController extends Controller
{
    public $data = [];

    // Blood Group Index
    public function index(Request $request)
    {
        if (request()->ajax()) {
            $res = new BloodGroupService();
            return $res->index();
        }
        return view('dashboard.setting.bloodgroup.index');

    }



    // Show Add Blood Group Form
    public function create()
    {
        return view('dashboard.setting.bloodgroup.create_bloodGroup');
    }


    // Store Blood Group
    public function store(BloodGroupRequest $request)
    {

        $validateData = $request->validated();
        $createBlood = new BloodGroupService();
        $data = $createBlood->create($request);
        return $data;
    }




    // Edit Blood Group
    public function edit(BloodGroup $bloodGroup)
    {
        return view('dashboard.setting.bloodgroup.edit_bloodGroup', [

            'edit_data' => $bloodGroup,

        ]);
    }




    // Update Blood Group
    public function update(BloodGroupRequest $request, BloodGroup $bloodGroup)
    {
        $validateData = $request->validated();
        $updateBlood = new BloodGroupService();
        $data = $updateBlood->update($request, $bloodGroup);

        return $data;       
    }



    // Delete Blood Group Data
    public function destroy(BloodGroup $bloodGroup)
    {
        $deleteBlood = new BloodGroupService();
        return $deleteBlood->delete($bloodGroup);
    }
}
