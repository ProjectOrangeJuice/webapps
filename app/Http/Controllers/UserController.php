<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Illuminate\Support\Facades\Gate;
use Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view("user/index",["user"=>$user]);
    }

    public function perUser($user){
        $user = User::where("name",$user)->first();;
        return view("user",["user"=>$user]);
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
    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            "password"=> 'required|min:5|max:100',
            "email"=>"required|email",
        ]);
        if($request["new-password"] != ""){
        $np = Hash::make($request["new-password"]);
        }else{
            $np = "nah";
        }
        if(Gate::allows("edit-user",$user)){
            if(!Hash::check($data["password"],$user->password)){
                return back()->withErrors("Password doesn't match");
               
            }else{
                if($np != "nah"){
                    $user->password = $np;
                }
                $user->email = $data["email"];
                $user->save();
                return redirect()->back();
            }
        }else{
            return response("",403);
        }

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
