<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
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
                ->setPath('')
        );
    }

    public function store(StoreBookRequest $request)
    {
        $newBook = Book::query()->create($request->validated());
        return BookResource::make($newBook);
    }

    public function show(Book $book)
    {
        return BookResource::make($book);
    }

    public function update(StoreBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return BookResource::make($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return [
            'data' => [
                'message' => 'Book deleted successfully',
            ]
        ];
    }

    public function schema()
    {
        return [
            'authors' => Author::all()->pluck('name', 'id'),
            'publishers' => Publisher::all()->pluck('name', 'id'),
        ];
    }
}
