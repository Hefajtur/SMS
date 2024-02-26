<?php

namespace App\Http\Controllers\gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GallaryCategory;
use App\Models\Gallary;
use App\Services\gallery\ImageService;
use App\Http\Requests\gallery\ImageRequest;

class galleryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $imageService= new ImageService();
            return ($imageService -> index());
         
          }
        return view('dashboard.gallery.images.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.gallery.images.create',[
            'GallaryCategoryies' => GallaryCategory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request)
    {
        $validator = $request->validated();
        $imageService= new ImageService();
        return $imageService -> create($request);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('dashboard.gallery.images.edit', [

            "gallary" => Gallary::find($id),
            'GallaryCategoryies'  => GallaryCategory::all(),
          
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ImageRequest $request)
    {
        $validator = $request->validated();
        $imageService= new ImageService();
        return $imageService -> update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $imageService= new ImageService();
        return $imageService -> destroy($id);
    }
}
