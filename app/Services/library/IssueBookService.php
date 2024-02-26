<?php

namespace App\Services\library;

use App\Models\IssueBook;
use Yajra\DataTables\DataTables;

/**
 * Class IssueBookService.
 */
class IssueBookService
{
    private $data = [];

    public function index()
    {
        $data = IssueBook::with('books', 'users')->get();
  
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {

                if ($data->status == 1) {
                    return '<span class="badge_status_act">Active</span>';
                } else {
                    return '<span class="badge_status_inact">Inactive</span>';
                }
            })
            ->addColumn('issue_date', function ($data) {

                return \Carbon\Carbon::parse( $data->issue_date )->format('d M Y');
            })
            ->addColumn('return_date', function ($data) {

                return \Carbon\Carbon::parse( $data->return_date )->format('d M Y');
            })
            ->addColumn('action', function ($data) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" id="issueBook_edit" issueBook_id="' . $data->id . '" ><i class="fa-regular fa-pen-to-square"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="issueBook_del" issueBook_id="' . $data->id . '" ><i class="fa-solid fa-trash-can"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'status', 'issue_date', 'return_date'])
            ->make();
    }



    // Create Book
    public function create($request)
    {
        // dd($request->all());
        $data = new IssueBook();

        $data->issue_book = $request->issue_book;
        $data->issue_book_member = $request->issue_book_member;
        $data->issue_date = $request->issue_date;
        $data->return_date = $request->return_date;
        $data->phone = $request->phone; 
        $data->description = $request->description;
        $data->save();

        $result['success'] = true;
        return $result;
    }


    // Update Book
    public function update($request, $result)
    {

        $data = IssueBook::find($result->id);
        $data->issue_book = $request->issue_book;
        $data->issue_book_member = $request->issue_book_member;
        $data->issue_date = $request->issue_date;
        $data->return_date = $request->return_date;
        $data->phone = $request->phone; 
        $data->status = $request->status; 
        $data->description = $request->description;
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

        $del_book = IssueBook::find($result->id);

        if ($del_book) {
            $del_book->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => false]);
        }
    }
}
