<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Volt\Volt;


Route::redirect('/', '/posts')->name('home');


Route::get('/pruebas', function(){
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/posts/{post}', [PostController::class, 'show'])
        ->name('posts.show');

// Route::get('dashboard', CreatePost::class)
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');


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


Route::get('/prueba', function(Request $request) {
    $post = Post::findOrFail($request->query('id'));

    if (!$post->image_path || !Storage::exists($post->image_path)) {
        return back()->with('alert', 'Image not found or does not exist.');
    }
    return Storage::download($post->image_path);
})->name('prueba');


require __DIR__.'/auth.php';
//require __DIR__.'/admin.php';
