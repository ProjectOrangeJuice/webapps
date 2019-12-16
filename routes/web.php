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
    return view('index', ["hideSearch"=>true]);
})->name("home");

Route::get('/tags', "TagController@index")->name("tag.index");

Route::get('/search', "SearchController@search")->name("search.index");
Route::get('/logout', 'Auth\LoginController@logout');


Route::get("/users/{user}", "UserController@perUser")->name("user.show");

Route::get("/post/{id}","PostController@perPost")->name("post.show");
Route::get("/postData/{id}","PostController@data");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home2');

Route::get("/post","PostController@create");

Route::post("/post","PostController@store");

Route::post("/images","PostController@imageUpload");
Route::delete("/image/{img}","PostController@imageDelete");

Route::get("/admin/users","AdminController@users");
Route::get("/admin/user/{user}","AdminController@user");
Route::put("/admin/user/{user}","AdminController@updateUser");
Route::delete("/admin/user/{user}","AdminController@deleteUser");

Route::get("/admin/tags","AdminController@tags");
Route::post("/admin/tags/make","AdminController@makeTag");
Route::post("/admin/tags/delete","AdminController@deleteTag");

Route::post("/comment/{post}",  "CommentController@store")->name("createComment");
Route::delete("/comment/{post}",  "CommentController@destroy")->name("deleteComment");