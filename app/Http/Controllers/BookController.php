<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class BookController extends Controller
{
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

    public function create()
    {
        return [
            'schema' => $this->schema(),
        ];
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return [
            'data' => [
                'name' => $book->name,
                'language' => $book->language,
                'subject' => $book->subject,
                'author_id' => (string)$book->author_id,
                'publisher_id' => (string)$book->publisher_id,
                'page_count' => (string)$book->page_count,
                'original' => $book->original,
                'barrowable' => $book->barrowable,
            ],
            'schema' => $this->schema()
        ];
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

    protected function schema()
    {
        return [
            'authors' => Author::all()->pluck('name', 'id'),
            'publishers' => Publisher::all()->pluck('name', 'id'),
        ];
    }
}
