@extends("layouts.master")

@section("content")


<h1>Your account</h1>
<div class="row">

<div class="col-8">
<h2>Your posts</h2>

@foreach ($user->posts as $post)
<a href="{{ route('post.show',['id' => $post->id])}}" class="text-body">
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
<p class="text-success"> {{ count($post->comments) }} comments

@endforeach
</div>

<div class="col-">
    <form action="POST" method="">
        <div class="form-group">
            Username: {{$user->name}}
          </div>
          <div class="form-group">
        Current password: <input type="password" name="password">
    </div>
        <div class="form-group">
        New password: <input type="password" name="np">
    </div>
    <div class="form-group">
        Email: <input type="text" name="email" value="{{$user->email}}">
    </div>
    <div class="form-group">
        Tags you admin:   @foreach($user->admins as $tag)
            {{ $loop->first ? '' : "," }}
            {{ $tag->tag }}
            @endforeach
        </div>
       
    </form>
</div>

</div>

@endsection

