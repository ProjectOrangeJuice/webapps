@extends("layouts.master")

@section("content")
<h1>{{ $post->title }} </h1>
<div class="row">
<div class="col-sm">
<p>Tags: @foreach($post->tags as $tag)
{{ $loop->first ? '' : "," }}
{{ $tag->tag }}
@endforeach
</p></div>
<div class="col-sm">
<p>Author: {{ $post->user->name }}</p></div>
<div class="col-sm">
<p>Date: {{ $post->created_at }}</p></div>
</div>

<p> {{ $post->content }}</p>

<hr>
<h2>Comments</h2>
@endsection