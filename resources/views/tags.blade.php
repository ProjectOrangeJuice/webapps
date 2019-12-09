@extends("layouts.master")


@section("content")
<h1> {{ $tag->tag }}</h1>
@if (count($posts) === 0)
    <p>No posts found for this tag!</p>
@endif
 @foreach ($posts as $post)
    <p>Title : {{ $post->title }}</p>
    <p> Content: {{ $post->content }}</p>
    
@endforeach


@endsection