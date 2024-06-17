<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\LoanResource;
use App\Http\Resources\UserResource;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Services\BookLoanService;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class LoanController extends Controller
{
    public function index()
    {
        $query = QueryBuilder::for(Loan::class)
            ->with(['user', 'book'])
            ->allowedSorts(['id', 'name', 'lastname', 'email'])
            ->defaultSort('-id');

        if (auth()->user()->role === 'user') {
            $query->where('user_id', auth()->user()->id);
        }

        return LoanResource::collection(
            $query->paginate()->setPath('')
        );
    }

    public function create()
    {
        return [
            'schema' => $this->schema(),
        ];
    }

    public function store(StoreLoanRequest $request)
    {
        $bookId = $request->validated('book_id');
        $userId = $request->validated('user_id');

        try {
            $user = User::find($userId);
            $book = Book::find($bookId);

            $loan = app(BookLoanService::class)->barrow($user, $book);

            return LoanResource::make($loan);
        } catch (\Exception $e) {
            return [
                'data' => [
                    'variant' => 'error',
                    'message' => $e->getMessage(),
                ]
            ];
        }
    }

    public function show(Loan $loan)
    {
        LoanResource::wrap('data');
        return LoanResource::make($loan);
    }

    public function edit(Loan $loan)
    {
        $service = app(BookLoanService::class);
        $lateDays = max($service->calculateLateDays($loan), 0);
        $lateFee = $service->calculateLateFee($loan, $lateDays);

        return [
            'data' => LoanResource::make($loan),
            'schema' => [],
            'meta' => [
                'late_days' => $lateDays,
                'late_fee' => $lateFee,
            ]
        ];
    }

    public function update(Request $request, Loan $loan)
    {
        //
    }

    public function destroy(Loan $loan)
    {
        return [
            'data' => [
                'variant' => 'error',
                'message' => 'You cannot do that!',
            ]
        ];
    }

    protected function schema()
    {
        return [
            'books' => BookResource::collection(Book::all()),
            'users' => UserResource::collection(User::all()),
        ];
    }
}
