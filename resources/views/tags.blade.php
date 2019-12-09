@extends("layouts.master")


@section("content")

{{ $tag }}
 @foreach ($posts as $post)
    <p>Title : {{ $post->title }}</p>
    <p> Content: {{ $post->content }}</p>
    
@endforeach


@endsection