<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/test', function () {
    $randomPass = Str::password(32, true, true, false);
   dd($randomPass);
});

require __DIR__.'/auth.php';
