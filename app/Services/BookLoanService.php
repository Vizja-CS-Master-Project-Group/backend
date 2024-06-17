<?php

namespace App\Services;

use App\Http\Resources\LoanResource;
use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Settings\Settings;

class BookLoanService
{

    public function barrow(User $user, Book $book): Loan
    {
        $borrowed = Loan::query()
            ->where('book_id', $book->getKey())
            ->whereNull('returned_at')
            ->exists();

        if ($borrowed) {
            throw new \Exception('This book is already borrowed.');
        }

        return Loan::query()->create([
            'user_id' => $user->getKey(),
            'book_id' => $book->getKey(),
        ]);
    }

    public function return(Loan $loan): Loan
    {
        $lateDays = $this->calculateLateDays($loan);
        if ($lateDays > 0) {
            $loan->fee = $this->calculateLateFee($loan, $lateDays);
        }

        $loan->returned_at = now();
        $loan->save();

        return $loan;
    }

    public function calculateLateDays(Loan $loan)
    {
        $diff = $loan->barrow_at->diffInDays();
        return ((int) $diff) - $this->maxDaysForBarrow();
    }

    public function calculateLateFee(Loan $loan, int $lateDays)
    {
        return $lateDays * $this->lateFeeRate();
    }

    protected function lateFeeRate(): float
    {
        return app(Settings::class)->late_fee;
    }

    protected function maxDaysForBarrow(): int
    {
        return app(Settings::class)->max_days;
    }

}
