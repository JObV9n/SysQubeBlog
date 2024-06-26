<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PostController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/posts', [PostController::class, 'index']);
    Route::get('/admin/posts/{post}', [PostController::class, 'show']);
    Route::post('/admin/posts', [PostController::class, 'store']);
    Route::put('/admin/posts/{post}', [PostController::class, 'update']);
    Route::delete('/admin/posts/{post}', [PostController::class, 'destroy']);
});

Route::get('/posts/{id}', [PostController::class, 'detail']);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
