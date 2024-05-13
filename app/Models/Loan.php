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
 * @property int $author_id
 * @property int $publisher_id
 *
 * @property Carbon $barrow_at
 * @property Carbon|null $returned_at
 * @property string|null $total_fee
 */
class Loan extends Model
{
    use HasFactory, SoftDeletes;

    protected static $unguarded = true;
}
