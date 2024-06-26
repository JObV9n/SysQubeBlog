<?php

use Illuminate\Support\Facades\Route; 

Route::get('/',function(){
    return view('app');
});
Route::get('/{any}',function(){
    return view('app');
})->where('any','^(?|register|login|posts\/.*$).*');


// Route::get('/posts', [PostController::class, 'index']);

require __DIR__.'/auth.php';
