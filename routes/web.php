<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
    Route::resource('posts', App\Http\Controllers\PostController::class)->except(['index', 'edit', 'update']);

 // Profile routes
 Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'showCurrent'])->name('profile.current');
 Route::get('/profile/{user}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/posts/{post}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/posts/{post}/likes', [App\Http\Controllers\LikeController::class, 'store'])->name('likes.store');
    Route::delete('/posts/{post}/likes', [App\Http\Controllers\LikeController::class, 'destroy'])->name('likes.destroy');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
