<?php

namespace App\Http\Controllers\gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GallaryCategory;
use App\Services\gallery\GalleryCategoryService;
use App\Http\Requests\gallery\galleryCategoryRequest;

class galleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $GalleryCategoryService= new GalleryCategoryService();
            return ($GalleryCategoryService -> index());
         
          }
        return view('dashboard.gallery.galleryCategory.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.gallery.galleryCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(galleryCategoryRequest $request)
    {
        // $validator = $request->validated();
        $GalleryCategoryService= new GalleryCategoryService();
        return $GalleryCategoryService -> create($request); 
    }

  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard.gallery.galleryCategory.edit', [

            'gallaryCategory' => GallaryCategory::find($id)  
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(galleryCategoryRequest $request, $id)
    {
        $GalleryCategoryService= new GalleryCategoryService();
        return $GalleryCategoryService -> update($request, $id); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $GalleryCategoryService= new GalleryCategoryService();
        return $GalleryCategoryService -> destroy($id); 
    }
}
