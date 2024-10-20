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
    return view('index');
})->name("home");

Route::get('/tags', "TagController@index")->name("tag.index");

Route::get('/search', "SearchController@search")->name("search.index");


Route::get("/users/{user}", "UserController@perUser")->name("user.show");

Route::get("/post/{id}","PostController@perPost")->name("post.show");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home2');
