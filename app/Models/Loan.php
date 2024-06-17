<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 *
 * @property Carbon $barrow_at
 * @property Carbon|null $returned_at
 * @property string|null $fee
 *
 * @property-read User $user
 * @property-read Book $book
 */
class Loan extends Model
{
    use HasFactory, SoftDeletes;

    protected static $unguarded = true;

    protected $casts = [
        'barrow_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function (Loan $loan) {
            $loan->barrow_at = now();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
