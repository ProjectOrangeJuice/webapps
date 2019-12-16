@extends("layouts.master")

@section("content")



<div class="row">
<div class="col-lg">
<h1>{{ $post->title }} </h1>
</div>
<div class="col">
<p>Tags: @foreach($post->tags as $tag)
{{ $loop->first ? '' : "," }}
<a href="{{ route('tag.index',['search' => $tag->tag])}}">{{ $tag->tag }}</a>
@endforeach
</p>
<p>Author: {{ $post->user->name }}</p>

<p>Date: {{ $post->created_at }}</p>
</div>
</div>


<p> {{ $post->content }}</p>
@foreach ($post->images as $image)

<img src="/publicImg/{{$image->location}}">
    
@endforeach
<hr>
<h2>Comments</h2>
<script>
  var urlToSend = "{{route('createComment',$post->id)}}";
  var userId = {{ Auth::id() ?? -1 }};
  </script>
<div id="app">
  <comments></comments>
</div>

@endsection

