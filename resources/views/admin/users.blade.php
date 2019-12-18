@extends("layouts.master")

@section("content")
<h1> User accounts </h1>
<hr>

@foreach ($users as $user)

<li><a href="{{route("admin.user",["user"=>$user->id])}}">{{$user->name}}, {{$user->email}}</a></li>

@endforeach

@endsection