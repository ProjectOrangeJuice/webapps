@extends("layouts.master")

@section("content")


<h1>Your account</h1>
<div class="row">

<div class="col">
<h2>Your posts</h2>
@foreach ($user->posts as $post)
    

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

@endforeach
</div>

<div class="col">
    <form action="POST" method="">
        Username: {{$user->name}}
        Current password: <input type="password" name="password">
        New password: <input type="password" name="np">
        Email: <input type="text" name="email" value="{{$user->email}}">
        Tags you admin:  <p>Tags: @foreach($user->tags as $tag)
            {{ $loop->first ? '' : "," }}
            {{ $tag->tag }}
            @endforeach
    </form>
</div>

</div>

@endsection

