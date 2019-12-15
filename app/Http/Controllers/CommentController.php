<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
class CommentController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($post, Request $request)
    {
        //check post exists
        if(!Post::find($post)){
            return response('',404);
        }

        if(Auth::check()){
            $validatedData = $request->validate([
                "comment" => "required|min:5|max:1000"
               ]);
               $comment = strip_tags($validatedData["comment"]);
               $newComment = New App\Comment;
               $newComment->comment = $comment;
               $newComment->post = $post;
               $newComment->user = Auth::user()->id;
               $newComment->save();
               return response($newComment, 200);
        }else{
            return response('', 401);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
