<?php

namespace App\Services\library;

use App\Models\library\Book;
use Yajra\DataTables\DataTables;

/**
 * Class BookService.
 */
class BookService
{
    private $data = [];

    public function index()
    {
        $data = Book::with('BookCategory')->latest()->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {

                if ($data->status == 1) {
                    return '<span class="badge_status_act">Active</span>';
                } else {
                    return '<span class="badge_status_inact">Inactive</span>';
                }
            })
            ->addColumn('bookCat', function ($data) {

                return $data->BookCategory->book_cat_name;
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="book_edit" book_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="book_del" book_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'bookCat'])
            ->make();
    }



    // Create Book
    public function create($request)
    {
        // dd($request->all());
        $data = new Book();

        $data->book_category_id = $request->book_category_id;
        $data->name = $request->name;
        $data->code = $request->code;
        $data->publisher_name = $request->publisher_name;
        $data->author_name = $request->author_name;
        $data->rack_no = $request->rack_no;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->description = $request->description;
        $data->status = $request->status;
        $data->save();

        $result['success'] = true;
        return $result;
    }


    // Update Book
    public function update($request, $result)
    {

        $data = Book::find($result->id);
        $data->book_category_id = $request->book_category_id;
        $data->name = $request->name;
        $data->code = $request->code;
        $data->publisher_name = $request->publisher_name;
        $data->author_name = $request->author_name;
        $data->rack_no = $request->rack_no;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->description = $request->description;
        $data->status = $request->status;

        $data->save();

        if ($data) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }



    // Delete Book 
    public function delete($result)
    {

        $del_book = Book::find($result->id);

        if ($del_book) {
            $del_book->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
