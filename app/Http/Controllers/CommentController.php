<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use Auth;
use Gate;

class CommentController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($post, Request $request)
    {
        //check post exists
        if (!Post::find($post)) {
            return response('', 404);
        }


        $validatedData = $request->validate([
            "comment" => "required|min:5|max:1000"
        ]);
        $comment = strip_tags($validatedData["comment"]);
        $newComment = new Comment;
        $newComment->comment = $comment;
        $newComment->post_id = $post;
        $newComment->user_id = Auth::id();
        $newComment->save();
        return response($newComment, 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
      

        if (Gate::allows("edit-comment",$comment)) {
            //get the comment
           
            $comment->delete();
        } else {
            abort(403);
        }
    }
}
