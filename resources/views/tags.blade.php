@extends("layouts.master")


@section("content")
<h1> {{ $tag->tag }}</h1>
<hr>
@if (count($posts) === 0)
    <p>No posts found for this tag!</p>
@endif
 @foreach ($posts as $post)
    <h3>{{ $post->title }}</h3>
    <h5> {{ $post->user }} </h5>
    <p>{{ Str::limit($post->content,250,"...") }}</p>
    
@endforeach


@endsection