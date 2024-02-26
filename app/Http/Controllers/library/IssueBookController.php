<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use App\Http\Requests\library\IssueBookRequest;
use App\Models\IssueBook;
use App\Models\library\Book;
use App\Models\Member;
use App\Models\User;
use App\Services\library\IssueBookService;
use Illuminate\Http\Request;

class IssueBookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $res = new IssueBookService();
            return $res->index();
        }

        return view('dashboard.library.issueBook.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.library.issueBook.create', [
            'books' => Book::all(),
            'members' => Member::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IssueBookRequest $request)
    {
        $validateData = $request->validated();
        $issueBook = new IssueBookService();
        $data = $issueBook->create($request);
       
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
    public function edit(IssueBook $issueBook)
    {
        return view('dashboard.library.issueBook.edit', [
            'edit_data' => $issueBook,
            'books' => Book::all(),
            'members' => Member::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IssueBookRequest $request, IssueBook $issueBook)
    {
        // dd($issueBook->id);
        $validateData = $request->validated();
        $updateIssueBook = new IssueBookService();
        $data = $updateIssueBook->update($request, $issueBook);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IssueBook $issueBook)
    {
        // dd($religion);
        $deleteIssuBook = new IssueBookService();
        return $deleteIssuBook->delete($issueBook);
    }
}
