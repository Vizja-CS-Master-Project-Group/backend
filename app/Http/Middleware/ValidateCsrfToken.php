<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken as BaseVerifier;

class ValidateCsrfToken extends BaseVerifier
{
    protected $except = [
        '*',
    ];
}
