<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            if($request->has("search")){
                $tagText = $request->search;
                $tag = Tag::where("tag",$tagText)->first();

                if($tag == null){
                    return view("tags")->withErrors(["The tag $tag was not found"]);
                }else{
                    $posts = $tag->posts()->paginate(10)->appends(["search"=>$tag->tag]);
                    return view("tags",["tag"=>$tag,"posts"=>$posts]);
                }
                
                
            }else{
                $tagFound = false;
                while(!$tagFound){
                    $tag = Tag::all()->random();
                    if(count($tag->posts) > 0){
                        $tagFound = true;
                    }
                }
                return redirect()->route('tag.index', ['search' => $tag->tag]);
            }
            
    }

    public function mod(Tag $tag){
        $posts = $tag->posts->where("pivot.confirmed",false);
        return view("admin/modTags",["tag"=>$tag,"posts"=>$posts]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
