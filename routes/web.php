<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\TaskoneController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes([
    'verify' => true
]);

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/search', [PostController::class, 'search'])->name('search');
Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::resource('posts', PostController::class)->except(['show', 'index']);
    Route::resource('comments', CommentController::class);

});




// Task 1

Route::get('/problemone', [TaskoneController::class, 'problemOne']);
Route::get('/problemtwo', [TaskoneController::class, 'problemTwo']);
Route::post('/problemtwo', [TaskoneController::class, 'problemTwoform'])->name('problemTwoform');
Route::get('/problemthree', [TaskoneController::class, 'problemThree']);
Route::post('/problemthree', [TaskoneController::class, 'problemThreeform'])->name('problemThreeform');

  


