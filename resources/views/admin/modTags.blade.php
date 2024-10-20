@extends("layouts.master")

@section("content")
<h1> Mod {{$tag->tag}} </h1>
<hr>
  
@foreach ($posts as $post)
@foreach ($posts as $post)
<form action="{{ route("post.mod",["post"=>$post->id])}}" method="POST">
    @csrf
    <input type="hidden" value="{{$tag->tag}}" name="tag">
    <a target="_blank" href="{{ route('post.show',['id' => $post->id])}}" class="text-body">
        <div>
        <h2>{{ $post->title }}</h2>
        <h5> By {{ $post->user->name }} </h5>
        <p>Tags: @foreach($post->tags as $tag)
{{ $loop->first ? '' : "," }}
{{ $tag->tag }}
@endforeach
</p>
        <p>{{ Str::limit($post->content,250,"...") }}</p>
        </div>
    </a>
        
   

<input type="submit" name="confirm" value="Confirm">
<input type="submit" name="confirm" value="Deny">
</form>
@endforeach
    
@endforeach


@endsection