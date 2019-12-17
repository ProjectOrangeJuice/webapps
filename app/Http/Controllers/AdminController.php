<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tag;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function users()
    {
        if (Gate::allows("admin-tasks")) {
            $users = User::all();
            return view("admin/users", ["users" => $users]);
        } else {
            abort(403);
        }
    }

    public function tags()
    {
        if (Gate::allows("admin-tasks")) {
            $tags = Tag::all();
            return view("admin/tags", ["tags" => $tags]);
        } else {
            abort(403);
        }
    }

    public function makeTag(Request $request)
    {
        if (Gate::allows("admin-tasks")) {
            $tag = new Tag;
            $tag->tag = $request->tag;
            $tag->save();
            return redirect()->back();
        } else {
            abort(403);
        }
    }

    public function deleteTag(Request $request)
    {
        if (Gate::allows("admin-tasks")) {
            $tag = Tag::where("tag", $request->tag)->first();
            $tag->delete();
            return redirect()->back();
        } else {
            abort(403);
        }
    }

    public function user($id)
    {
        if (Gate::allows("admin-tasks")) {
            $user = User::find($id);
            return view("admin/user", ["user" => $user]);
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

            foreach ($request->tags as $tag) {
                $tag = Tag::where("tag", $tag)->first();
                if ($tag != null) {
                    $user->admins()->attach($tag);
                }
            }
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
