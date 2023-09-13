<?php

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

Route::get('/', function () {
    return 'Hello word';
});

Route::get('/posts', 'App\Http\Controllers\PostController@index');
Route::get('/posts/create', 'App\Http\Controllers\PostController@create');
Route::get('/posts/update', 'App\Http\Controllers\PostController@update');
Route::get('/posts/delete', 'App\Http\Controllers\PostController@restoreAfterSoftDelete');
