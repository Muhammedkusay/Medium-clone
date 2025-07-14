<?php

use App\Http\Controllers\ClapController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PublicProfileController;

Route::get('/', [PostController::class, 'index'])->name('dashboard');

Route::get('/@{user:username}', [PublicProfileController::class, 'show'])->name('profile.show');

Route::get('/category/{category}', [PostController::class, 'category'])->name('post.byCategory');
Route::get('/@{username}/{post:slug}', [PostController::class, 'show'])->name('post.show');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');

    Route::get('/post/{post:slug}', [PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/create', [PostController::class, 'store'])->name('post.store');

    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::get('/user-posts', [PostController::class, 'userPosts'])->name('post.userPosts');

    Route::post('follow/{user}', [FollowerController::class, 'followUnFollow'])->name('follow');
    Route::post('clap/{post}', [ClapController::class, 'clap'])->name('clap');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
