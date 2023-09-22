<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\HomeController@index');


Route::get('/posts', 'App\Http\Controllers\Post\IndexController')->name('post.index');
Route::get('/posts/create', 'App\Http\Controllers\Post\CreateController')->name('post.create');


Route::post('/posts', 'App\Http\Controllers\Post\StoreController')->name('post.store');
Route::get('/posts/{post}', 'App\Http\Controllers\Post\ShowController')->name('post.show');
Route::get('/posts/{post}/edit', 'App\Http\Controllers\Post\EditController')->name('post.edit');
Route::patch('/posts/{post}', 'App\Http\Controllers\Post\UpdateController')->name('post.update');
Route::delete('/posts/{post}', 'App\Http\Controllers\Post\DestroyController')->name('post.delete');

Route::get('/admin/post', 'App\Http\Controllers\Admin\Post\IndexController')->name('admin.post.index');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

