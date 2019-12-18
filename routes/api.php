<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//  Route::middleware('auth:api')->get('/user', function (Request $request) {
//      return $request->user();
//  });


Route::middleware('auth:api')->get('/notepad', function (Request $request) {
    return $request->user()->notepad;
})->name("notepad");

Route::middleware('auth:api')->put('/notepad', function (Request $request) {
    $notes = htmlspecialchars($request->notes);
    $user = $request->user();
    $request->user()->notepad->content = $notes;
    $request->user()->save();

})->name("notepad.update");

Route::get("/comments/{post}", "CommentController@fromPost")->name("comments");

Route::middleware('auth:api')->get("/postData/{id}","PostController@data")->name("post.data");


Route::middleware('auth:api')->post("/post","PostController@store")->name("post.update");
Route::middleware('auth:api')->delete("/post/{post}","PostController@destroy")->name("post.delete");

Route::middleware('auth:api')->post("/images","PostController@imageUpload")->name("image.upload");
Route::middleware('auth:api')->delete("/image/{img}","PostController@imageDelete")->name("image.delete");

Route::middleware('auth:api')->put("/admin/user/{user}","AdminController@updateUser")->name("admin.user.update");
Route::middleware('auth:api')->delete("/admin/user/{user}","AdminController@deleteUser")->name("admin.user.delete");

Route::middleware('auth:api')->post("/comment/{post}",  "CommentController@store")->name("createComment")->name("comment.create");
Route::middleware('auth:api')->delete("/comment/{post}",  "CommentController@destroy")->name("deleteComment")->name("comment.delete");