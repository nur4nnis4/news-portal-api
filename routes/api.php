<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/current-user', [AuthController::class, 'currentUser']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::controller(PostController::class)->group(function () {
        Route::get('/posts',  'index');
        Route::get('/posts/{id}',  'show');
        Route::post('/posts', 'store');
        Route::patch('/posts/{id}', 'update')->middleware('post-author');
        Route::delete('/posts/{id}', 'destroy')->middleware('post-author');
    });

    Route::controller(CommentController::class)->group(function () {
        Route::post('/comment', 'store');
        Route::delete('/comment/{id}', 'destroy')->middleware('comment-owner');
    });
});
