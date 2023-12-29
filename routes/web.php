<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 


    Route::resource('posts', PostController::class);
    Route::resource('comments', CommentController::class);

    Route::get('user/edit/', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/update', [UserController::class, 'update'])->name('user.update');
    Route::put('user/update-password', [UserController::class, 'changePassword'])->name('user.update.password');



  


