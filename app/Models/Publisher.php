<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $country
 * @property string $website
 */
class Publisher extends Model
{
    use HasFactory, SoftDeletes;

    protected static $unguarded = true;

}
