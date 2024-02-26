<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use App\Http\Requests\library\BookCategoryRequest;
use Illuminate\Http\Request;
use App\Http\Requests\setting\ReligionRequest;
use App\Models\library\BookCategory;
use App\Services\library\BookCategoryService;
use App\Services\ReligionService;

class BookCategoryController extends Controller
{

    public $data = [];
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $res = new BookCategoryService();
            return $res->index();
        }
        return view('dashboard.library.bookCategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.library.bookCategory.create_bookCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookCategoryRequest $request)
    {
        $validateData = $request->validated();
        $bookCategory = new BookCategoryService();
        $data = $bookCategory->create($request);
       
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
    public function edit(BookCategory $bookCategory)
    {

        return view('dashboard.library.bookCategory.edit_bookCategory', [
            'edit_data' => $bookCategory,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookCategoryRequest $request, BookCategory $bookCategory)
    {
        // dd($bookCategory->id);
        $validateData = $request->validated();
        $updateBookCategory = new BookCategoryService();
        $data = $updateBookCategory->update($request, $bookCategory);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookCategory $bookCategory)
    {
        // dd($religion);
        $deleteBookCategory = new BookCategoryService();
        return $deleteBookCategory->delete($bookCategory);
    }
}
