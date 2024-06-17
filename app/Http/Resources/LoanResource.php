<?php

namespace App\Http\Resources;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Loan
 */
class LoanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getKey(),
            'user' => UserResource::make($this->user),
            'book' => BookResource::make($this->book),
            'barrow_at' => $this->barrow_at,
            'returned_at' => $this->returned_at,
            'fee' => $this->fee,
            'late_days' => $this->barrow_at->diffInDays(),
        ];
    }
}
