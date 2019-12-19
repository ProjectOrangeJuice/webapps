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

app()->singleton(Qod::class, function ($app) {
    $q = new Qod();
    $q->newQuote();
    return $q;
});

Route::get('/', function (Qod $qod) {

    return view('index', ["hideSearch" => true, "qod" => $qod->getQuote()]);
})->name("home");

Route::get('/tags', "TagController@index")->name("tag.index");

Route::get('/search', "SearchController@search")->name("search.index");
Route::get('/logout', 'Auth\LoginController@logout')->name("logout");


Route::get("/users/{user}", "UserController@perUser")->name("user.show");

Route::get("/post/{id}", "PostController@perPost")->name("post.show");


Auth::routes();

Route::middleware('auth')->get("/post", "PostController@create")->name("post.create");





Route::middleware('auth')->get("/admin/users", "AdminController@users")->name("admin.users");
Route::middleware('auth')->get("/admin/user/{user}", "AdminController@user")->name("admin.user");


Route::middleware('auth')->get("/admin/tags", "AdminController@tags")->name("admin.tags");

//These are the basic form posts.
Route::middleware('auth')->post("/admin/tags/make", "TagController@store")->name("admin.tags.store");
Route::middleware('auth')->post("/admin/tags/delete", "TagController@destroy")->name("admin.tags.destroy");

Route::middleware('auth')->get("/account", "UserController@index")->name("account");
Route::middleware('auth')->post("/account", "UserController@update")->name("account.update");


Route::middleware('auth')->get("/mod/{tag}", "TagController@mod")->name("tag.mod");
Route::middleware('auth')->post("/postMod/{post}", "PostController@update")->name("post.mod");
