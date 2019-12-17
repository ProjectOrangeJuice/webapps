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

use App\Quote\Qod;

app()->singleton(Qod::class,function($app){
    $q = new Qod();
    $q->newQuote();
    return $q;
});

Route::get('/', function (Qod $qod) {
   
    return view('index', ["hideSearch"=>true, "qod"=>$qod->getQuote()]);
})->name("home");

Route::get('/tags', "TagController@index")->name("tag.index");

Route::get('/search', "SearchController@search")->name("search.index");
Route::get('/logout', 'Auth\LoginController@logout')->name("logout");


Route::get("/users/{user}", "UserController@perUser")->name("user.show");

Route::get("/post/{id}","PostController@perPost")->name("post.show");


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home2');

Route::get("/post","PostController@create");





Route::get("/admin/users","AdminController@users");
Route::get("/admin/user/{user}","AdminController@user");


Route::get("/admin/tags","AdminController@tags");
Route::post("/admin/tags/make","AdminController@makeTag");
Route::post("/admin/tags/delete","AdminController@deleteTag");


Route::get("/account","UserController@index");
Route::post("/account","UserController@update");


Route::get("/mod/{tag}","TagController@mod");
Route::post("/postMod/{post}","PostController@update");

Route::post("/comment/{post}",  "CommentController@store")->name("createComment");
Route::delete("/comment/{post}",  "CommentController@destroy")->name("deleteComment");