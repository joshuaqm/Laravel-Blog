<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('categories', CategoryController::class);
Route::middleware(['auth'])->group(function () {
    // Rutas de lectura
    Route::middleware('can:posts.access')->group(function () {
        Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
        Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    });

    // Rutas de escritura (agrupadas)
    Route::middleware('can:posts.write')->group(function () {
        Route::resource('posts', PostController::class)->except(['index', 'show']);
    });
});
Route::resource('users', UserController::class);
Route::resource('tags', TagController::class);