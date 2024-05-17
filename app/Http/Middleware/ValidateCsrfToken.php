<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

class ValidateCsrfToken extends VerifyCsrfToken
{
    protected $except = [
        '*',
    ];
}
