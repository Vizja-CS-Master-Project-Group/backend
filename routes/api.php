<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/books/schema', [\App\Http\Controllers\BookController::class, 'schema']);

Route::resource('/books', \App\Http\Controllers\BookController::class)
    ->middleware(['auth:sanctum']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
