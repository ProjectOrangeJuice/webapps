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

        $this->middleware('auth')->except(["fromPost"]);
    }

    public function fromPost(Post $post, Request $request)
    {
        $comments = Comment::with(["user" => function ($query) {
            $query->select('name', "id");
        }])->where("post_id", $post->id)->orderBy('created_at', 'desc')->paginate(5);
        foreach ($comments as $comment) {
            //We don't use the auth middleware, so we have to get the user this way
            //so we can't use the gates
            $user = $request->user('api');
            if ($user) {
                if ($user->admin) {
                    $comment->canEdit = true;
                } else {
                    $comment->canEdit = $user->id == $comment->user_id;
                }
            }else{
                $comment->canEdit = false;
            }
        }
        return $comments;
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


        if (Gate::allows("edit-comment", $comment)) {
            //get the comment

            $comment->delete();
        } else {
            abort(403);
        }
    }
}
