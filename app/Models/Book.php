<?php

namespace App\Models;

use App\Helpers\IsbnHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property string $isbn // 1250178630
 * @property string $name // The ENIAC
 * @property string $language // E.g: 1 === English
 * @property string $subject // E.g.: The first computer
 *
 * @property int $author_id
 * @property Carbon|null $authored_at
 *
 * @property int $publisher_id
 * @property Carbon|null $published_at
 *
 * @property int $page_count
 * @property bool $original
 * @property bool $barrowable
 *
 * @property-read Author $author
 * @property-read Publisher $publisher
 */
class Book extends Model implements HasMedia
{

    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $attributes = [
        'original' => false,
        'barrowable' => false
    ];

    protected static $unguarded = true;

    protected static function booted()
    {
        static::creating(function (Book $book) {
            $book->isbn = IsbnHelper::generateIsbn13();
        });
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

}
