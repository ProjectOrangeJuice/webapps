@extends("layouts.master")

@section("content")
<h1>{{ $post->title }} </h1>
<p>Author: {{ $post->user->name }}</p>
<p> {{ $post->content }}</p>
@endsection