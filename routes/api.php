<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\PostApiController;

Route::post('/register', [UserApiController::class, 'register'])->name('api.register');
Route::post('/login', [UserApiController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->name('api.')->group(function () {
    Route::get('/me', [UserApiController::class, 'me'])->name('me');
    Route::post('/logout', [UserApiController::class, 'logout'])->name('logout');

    Route::get('/users', [UserApiController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserApiController::class, 'show'])->name('users.show');

    Route::apiResource('posts', PostApiController::class);

    Route::post('/posts/{id}/restore', [PostApiController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{id}/force-delete', [PostApiController::class, 'forceDelete'])->name('posts.forceDelete');
});
