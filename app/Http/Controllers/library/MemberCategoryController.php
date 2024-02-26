<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use App\Http\Requests\library\MemberCategoryRequest;
use App\Models\library\MemberCategory;
use App\Services\library\MemberCategoryService;
use Illuminate\Http\Request;

class MemberCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $res = new MemberCategoryService();
            return $res->index();
        }
        return view('dashboard.library.memberCategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.library.memberCategory.create_memberCat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberCategoryRequest $request)
    {
        $validateData = $request->validated();
        $memberCategory = new MemberCategoryService();
        $data = $memberCategory->create($request);
       
        return $data;
    
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
    public function edit(MemberCategory $memberCategory)
    {
        // dd($memberCategory);
        return view('dashboard.library.memberCategory.edit_memberCat', [
            'edit_data' => $memberCategory,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberCategoryRequest $request, MemberCategory $memberCategory)
    {
        // dd($memberCategory->id);
        $validateData = $request->validated();
        $updateMemberCategory = new MemberCategoryService();
        $data = $updateMemberCategory->update($request, $memberCategory);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MemberCategory $memberCategory)
    {
        // dd($religion);
        $deleteMemberCategory = new MemberCategoryService();
        return $deleteMemberCategory->delete($memberCategory);
    }
}
