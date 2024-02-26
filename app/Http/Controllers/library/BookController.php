<?php

namespace App\Http\Controllers\library;

use App\Http\Controllers\Controller;
use App\Http\Requests\library\BookRequest;
use App\Models\library\Book;
use App\Models\library\BookCategory;
use App\Services\library\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {

            $res = new BookService();
            return $res->index();
        }

        return view('dashboard.library.book.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.library.book.create', [
            'bookCats' => BookCategory::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $validateData = $request->validated();
        $book = new BookService();
        $data = $book->create($request);
       
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
    public function edit(Book $book)
    {

        return view('dashboard.library.book.edit', [
            'edit_data' => $book,
            'bookCats' => BookCategory::all(),
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, Book $book)
    {
        // dd($book->id);
        $validateData = $request->validated();
        $updateBook = new BookService();
        $data = $updateBook->update($request, $book);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // dd($religion);
        $deleteBook = new BookService();
        return $deleteBook->delete($book);
    }
}
