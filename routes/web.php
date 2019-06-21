<?php

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
    return view('welcome');
});

//Auth::routes();


Route::resource('posts', 'PostsController');

Route::resource('group', 'GroupController');

Route::resource('user', 'UserController');


Route::middleware('auth:api')->group( function () {
    Route::resource('api/posts', 'API\PostsController');
    Route::resource('api/group', 'API\GroupController');
    Route::resource('api/user', 'API\UserController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
