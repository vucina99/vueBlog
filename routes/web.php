<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\PostController::class, 'posts'])->name('posts');
Route::get('/logout', [App\Http\Controllers\PostController::class, 'logout'])->name('logout');
Route::get('/posts/{page?}', [App\Http\Controllers\PostController::class, 'postsData'])->name('postsData');
Route::post('/update-post', [App\Http\Controllers\PostController::class, 'updatePost'])->name('updatePost');
Route::post('/upload-image', [App\Http\Controllers\PostController::class, 'uploadImage'])->name('uploadImage');
Route::post('/upload-post', [App\Http\Controllers\PostController::class, 'uploadPost'])->name('uploadImage');
Route::post('/delete-post', [App\Http\Controllers\PostController::class, 'deletePost'])->name('deletePost');
Route::get('/full-post/{post_id}', [App\Http\Controllers\PostController::class, 'fullPost'])->name('fullPost');
