<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Post;
use App\User;

class SearchController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        if($request->has("users") && !$request->has("tags")){
            $users = explode(",",$request->users);
            //Get the user id
            $u = User::WhereIn("name",$users)->get();
            $ids = [];
            foreach($u as $user){
                array_push($ids,$user->id);
            }
            $selection = Post::WhereIn("user_id",$ids)->get();

        }elseif($request->has("tags") && !$request->has("users")){

            $tags = explode(" ",$request->tags);
            $tagPosts = Tag::WhereIn("tag",$tags)->get();
            foreach($tagPosts as $tag){
                if(isset($selection)){
                 
                $selection = $selection->merge($tag->posts);
                }else{
                    $selection = $tag->posts;
                }
            }
            
        }else{
            $users = explode(",",$request->users);
            //Get the user id
            $u = User::WhereIn("name",$users)->get();
            $tags = explode(" ",$request->tags);
    
            $ids = [];
            foreach($u as $user){
                array_push($ids,$user->id);
            }
            $selection = Post::WhereIn("user_id",$ids)->get();
            $selection = $selection->filter(function($value,$key) use ($tags){
                $tagged = [];
                foreach($value->tags as $tag){
                    array_push($tagged,$tag->tag);
                }
                                if(count((array_intersect($tagged,$tags))) > 0){
                    return true;
                }
            });

        }
        $request->flash();
        return view("searchReturn",["posts"=>$selection]);
    }

}
