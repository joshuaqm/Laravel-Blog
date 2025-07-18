<?php

use App\Http\Controllers\PostController;
use App\Livewire\CreatePost;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::redirect('/', '/login')->name('home');
Route::get('/pruebas', function(){
    $posts = Post::find(1);

    $comments = $posts->comments()->create([
        'content' => 'Este es un comentario de prueba'
    ]);
    
    return $comments;
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Route::get('dashboard', CreatePost::class)
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');
Route::view('/prueba', 'prueba')->name('prueba');

Route::get('dashboard', function () {
    return view('dashboard'); // Esto cargará tu vista dashboard.blade.php
})->middleware(['auth', 'verified'])
  ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

});


require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
