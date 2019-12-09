@extends("layouts.master")


@section("content")
<h1> {{ $tag->tag }}</h1>
<hr>
@if (count($posts) === 0)
    <p>No posts found for this tag!</p>
@endif
 @foreach ($posts as $post)
    <h2>{{ $post->title }}</h2>
    <h5> By {{ $post->user->name }} </h5>
    <p>{{ Str::limit($post->content,250,"...") }}</p>
    
@endforeach


@endsection