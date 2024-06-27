<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\PostController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard', [PostController::class, 'index']);
    Route::get('/dashboard/posts/{post}', [PostController::class, 'show']);
    Route::post('/dashboard/posts', [PostController::class, 'store']);
    Route::put('/dashboard/posts/edit/{post}', [PostController::class, 'update']);
    Route::get('/dashboard/posts/edit/{post}', [PostController::class, 'showPost']);
    
    Route::delete('/dashboard/posts/{post}', [PostController::class, 'destroy']);

});

//API response check
Route::get('/posts', [PostController::class, 'index']);

Route::get('/posts/{id}', [PostController::class, 'detail']);
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
