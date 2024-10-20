@extends("layouts.master")

@section("content")
<h1> User accounts </h1>
<hr>

@foreach ($users as $user)

<li><a href="/admin/user/{{$user->id}}">{{$user->name}}, {{$user->email}}</a></li>

@endforeach

@endsection