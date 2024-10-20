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


Route::middleware('auth:api')->get('/notepad', function (Request $request) {
    return $request->user()->notepad;
});

Route::middleware('auth:api')->put('/notepad', function (Request $request) {
    $notes = htmlspecialchars($request->notes);
    $user = $request->user();
    $request->user()->notepad->content = $notes;
    $request->user()->save();

});

Route::get("/comments/{post}", function($post){
    $comments = App\Comment::with(["user" => function ($query) {
        $query->select('name',"id");
    }])->where("post_id",$post)->orderBy('created_at', 'desc')->paginate(5);
   return $comments;
});

Route::middleware('auth:api')->get("/postData/{id}","PostController@data");


Route::middleware('auth:api')->post("/post","PostController@store");