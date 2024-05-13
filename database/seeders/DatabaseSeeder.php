<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'role' => 'librarian',
            'name' => 'Librarian',
            'lastname' => 'Test',
            'email' => 'librarian@vizja.com',
            'password' => Hash::make('123456789'),
        ]);

        User::factory()->create([
            'role' => 'user',
            'name' => 'User',
            'lastname' => 'Test',
            'email' => 'user@vizja.com',
            'password' => Hash::make('123456789'),
        ]);

        $this->readBooks();
    }

    protected function readBooks()
    {
        $booksFile = file_get_contents(base_path("database/data/books.json"));
        $books = json_decode($booksFile, true);

        foreach ($books as $book) {
            $this->createBook($book);
        }
    }

    protected function createBook(array $bookData)
    {
        try {
            $author = $this->createAuthor($bookData['bookAuthor']);
            $publisher = $this->createPublisher($bookData['bookPublisher']);

            $book = Book::factory()->create([
                'isbn' => $bookData['bookIsbn'],
                'name' => $bookData['bookTitle'],
                'language' => 'English',
                'subject' => $bookData['bookDescription'],
                'author_id' => $author->getKey(),
                'publisher_id' => $publisher->getKey(),
            ]);

            if ($bookImage = $bookData['bookImage']) {
                $media = $book->addMediaFromUrl($bookImage)
                    ->toMediaCollection('cover');
            }
        } catch (\Throwable $t) {
        }
    }

    protected function createAuthor(string $name)
    {
        $author = Author::query()->where('name', explode(' ', $name)[0]);
        if ($author->exists()) {
            return $author->first();
        }

        return Author::factory()->setName($name)->create();
    }

    protected function createPublisher(string $name)
    {
        $publisher = Author::query()->where('name', $name);
        if ($publisher->exists()) {
            return $publisher->first();
        }

        return Publisher::factory()->create([
            'name' => $name
        ]);
    }

}
