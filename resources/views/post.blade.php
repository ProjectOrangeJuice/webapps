@extends("layouts.master")

@section("content")
<div class="row">
<div class="col-lg">
<h1>{{ $post->title }} </h1>
</div>
<div class="col">
<p>Tags: @foreach($post->tags as $tag)
{{ $loop->first ? '' : "," }}
{{ $tag->tag }}
@endforeach
</p>
<p>Author: {{ $post->user->name }}</p>

<p>Date: {{ $post->created_at }}</p>
</div>
</div>


<p> {{ $post->content }}</p>

<hr>
<h2>Comments</h2>
@endsection