<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tag;
class AdminController extends Controller
{
    public function users(){
        $users = User::all();
        return view("admin/users",["users"=>$users]);
    }

    public function tags(){
        $tags = Tag::all();
        return view("admin/tags",["tags"=>$tags]);
    }

    public function makeTag(Request $request){
        $tag = new Tag;
        $tag->tag = $request->tag;
    }

    public function deleteTag(Request $request){
        $tag = Tag::where("tag",$request->tag)->first();
        $tag->delete();
    }

    public function user($id){
        $user = User::find($id);
        return view("admin/user",["user"=>$user]);
    }

    public function updateUser(Request $request, $id){
        $user = User::find($id);
        $data = $request->validate([
            "name" => "required|min:5|max:1000",
            "email"=> "email",
            "admin"=>"numeric",
        ]);

            $user->name = $data["name"];
            $user->email = $data["email"];
            $user->admin = $data["admin"];
            $user->save();

            foreach($request->tags as $tag){
                $tag = Tag::where("tag",$tag)->first();
                if($tag != null){
                    $user->admins()->attach($tag);
                }
            }
    }

    public function deleteUser($id){
        $user = User::find($id);
       $user->delete();
    }
}
