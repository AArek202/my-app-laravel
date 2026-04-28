<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::post('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('/posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
Route::resource('posts', PostController::class);