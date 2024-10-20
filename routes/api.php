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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/comments/{post}", function($post){
    return App\Comment::where("post_id",$post)->paginate(10);
});

Route::post("/comment/{post}",  "CommentController@store")->name("createComment");
// Route::update("/comment/{post}",  "CommentController@update")->name("updateComment");
// Route::delete("/comment/{post}",  "CommentController@destroy")->name("deleteComment");