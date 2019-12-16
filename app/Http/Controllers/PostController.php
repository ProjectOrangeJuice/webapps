<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Auth;
use App\Image;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function perPost($id){
        $post = Post::find($id);

        return view("post",["post"=>$post]);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            "title"=> 'required|min:5|max:100',
            "content"=>"required|min:5",
            "tags"=>"required",
        ]);
            
        $post = new Post;
        $post->title = $data["title"];
        $post->content = $data["content"];
        $post->user_id = Auth::id();
        $post->save();
        foreach($data["tags"] as $tag){
            $tag = Tag::where("tag",$tag)->first();
            if($tag != null){
                $post->tags()->attach($tag);
            }
        }
        
        return $post;
    }


    public function imageUpload(Request $request){
        request()->validate([

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

  

        $imageName = time().'.'.request()->image->getClientOriginalExtension();

  

        request()->image->move(public_path('publicImg'), $imageName);

        $image = new Image;
        $image->location = $imageName;
        $image->post_id = $request->post;
        $image->save();

        return $image;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
