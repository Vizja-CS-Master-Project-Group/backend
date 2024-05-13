<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('/books', \App\Http\Controllers\BookController::class);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
