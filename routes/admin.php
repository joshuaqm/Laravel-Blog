<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoryController::class);
Route::middleware(['auth', 'can:crear post'])->group(function () {
    Route::resource('posts', PostController::class);
});
Route::resource('users', UserController::class);
Route::resource('tags', TagController::class);