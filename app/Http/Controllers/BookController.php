<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return BookResource::collection(
            QueryBuilder::for(Book::class)
                ->with(['media', 'author'])
                ->allowedFields(['name', 'language'])
                ->allowedSorts(['name'])
                ->defaultSort('name')
                ->paginate()
                ->setPath('/api/books')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return BookResource::make($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
