<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $lastname
 * @property string $about
 * @property Carbon|null $birth_date
 * @property Carbon|null $dead_date
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon|null $deleted_at
 */
class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected static $unguarded = true;
}
