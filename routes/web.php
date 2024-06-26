<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
 

Route::get('/',function(){
    return view('app');
});
Route::get('/has/posts/{postId}', [PostController::class, 'showPost']);
Route::get('/{any}',function(){
    return view('app');
// })->where('any','^(?|register|login|posts|dashboard\/.*$).*');
})->where('any','.*');


require __DIR__.'/auth.php';
