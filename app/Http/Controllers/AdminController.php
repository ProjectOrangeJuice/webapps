<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tag;
use Gate;

class AdminController extends Controller
{
    public function users()
    {
        if (Gate::allows("admin-tasks")) {
            $users = User::all();
            return view("admin/users", ["title"=>"Users","users" => $users]);
        } else {
            abort(403);
        }
    }

    public function tags()
    {
        if (Gate::allows("admin-tasks")) {
            $tags = Tag::all();
            return view("admin/tags", ["title"=>"Tags","tags" => $tags]);
        } else {
            abort(403);
        }
    }


    public function user($id)
    {
        if (Gate::allows("admin-tasks")) {
            $user = User::find($id);
            return view("admin/user", ["title"=>"User","user" => $user]);
        } else {
            abort(403);
        }
    }

    public function updateUser(Request $request, $id)
    {
        if (Gate::allows("admin-tasks")) {
            $user = User::find($id);
            $data = $request->validate([
                "name" => "required|min:5|max:1000",
                "email" => "email",
                "admin" => "numeric",
            ]);

            $user->name = $data["name"];
            $user->email = $data["email"];
            $user->admin = $data["admin"];
            $user->save();
            $tags = $request->tags;
            $curTags = $user->admins;
            foreach ($curTags as $tag) {
                if (in_array($tag->tag, $tags)) {
                    //It's already a tag
                    unset($tags[array_search($tag->tag, $tags)]);
                }else{
                    $user->admins()->detach($tag->id);
                }
             
            }
            foreach ($tags as $tag) {
                $tag = Tag::where("tag", $tag)->first();
                if ($tag != null) {
                    $user->admins()->attach($tag);
                }
            }
            return $user;
        } else {
            abort(403);
        }
    }

    public function deleteUser($id)
    {
        if (Gate::allows("admin-tasks")) {
            $user = User::find($id);
            $user->delete();
        } else {
            abort(403);
        }
    }
}
