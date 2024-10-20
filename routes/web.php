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

Route::middleware('auth')->get("/post","PostController@create");





Route::middleware('auth')->get("/admin/users","AdminController@users");
Route::middleware('auth')->get("/admin/user/{user}","AdminController@user");


Route::middleware('auth')->get("/admin/tags","AdminController@tags");

//These are the basic form posts.
Route::middleware('auth')->post("/admin/tags/make","AdminController@makeTag");
Route::middleware('auth')->post("/admin/tags/delete","AdminController@deleteTag");

Route::middleware('auth')->get("/account","UserController@index");
Route::middleware('auth')->post("/account","UserController@update");


Route::middleware('auth')->get("/mod/{tag}","TagController@mod");
Route::middleware('auth')->post("/postMod/{post}","PostController@update");

