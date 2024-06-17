<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('/books', \App\Http\Controllers\BookController::class)
    ->middleware(['auth:sanctum']);

Route::resource('/users', \App\Http\Controllers\UserController::class)
    ->middleware(['auth:sanctum']);

Route::resource('/loans', \App\Http\Controllers\LoanController::class)
    ->middleware(['auth:sanctum']);

Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'index'])
    ->middleware(['auth:sanctum']);

Route::put('/settings', [\App\Http\Controllers\SettingController::class, 'update'])
    ->middleware(['auth:sanctum']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
