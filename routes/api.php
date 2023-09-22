<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
Route::group(['namespace' => 'App\Http\Controllers\Post', 'middleware' => 'jwt.auth'], function () {
    Route::get('/posts', 'IndexController');
    Route::get('/posts/create', 'App\Http\Controllers\Post\CreateController');
    Route::post('/posts', 'App\Http\Controllers\Post\StoreController');
    Route::get('/posts/{post}', 'App\Http\Controllers\Post\ShowController');
    Route::get('/posts/{post}/edit', 'App\Http\Controllers\Post\EditController');
    Route::patch('/posts/{post}', 'App\Http\Controllers\Post\UpdateController');
    Route::delete('/posts/{post}', 'App\Http\Controllers\Post\DestroyController');
});

