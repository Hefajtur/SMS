<?php

namespace App\Services\library;

use App\Models\library\BookCategory;
use Yajra\DataTables\DataTables;

/**
 * Class BookCategoryService.
 */
class BookCategoryService
{
    private $data = [];

    public function index()
    {
        $data = BookCategory::latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {

                if ($data->status == 1) {
                    return '<span class="badge_status_act">Active</span>';
                } else {
                    return '<span class="badge_status_inact">Inactive</span>';
                }
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="bookCategory_edit" bookCategory_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i> Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="bookCategory_del" bookCategory_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i> Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }



    // Create Book Category
    public function create($request)
    {

        $data = new BookCategory();

        $data->book_cat_name = $request->book_cat_name;
        $data->status = $request->status;
        $data->save();

        $result['success'] = true;
        return $result;
    }



    // Update Book Category
    public function update($request, $result)
    {

        $data = BookCategory::find($result->id);
        $data->book_cat_name = $request->book_cat_name;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Delete Book Category
    public function delete($result)
    {

        $del_bookCat = BookCategory::find($result->id);

        if ($del_bookCat) {
            $del_bookCat->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
