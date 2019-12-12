@extends("layouts.master")

@section("content")
<h1> {{ $user->name ?? "Oops!" }}</h1>
<hr>
@if (count($user->posts ?? []) === 0)
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li> {{ $error }}
            @endforeach
        </div>
    @else
        <p>No posts found for this user!</p>
    @endif
    
@else
    @foreach ($user->posts as $post)
    <a href="{{ route('post.show',['id' => $post->id])}}" class="text-body">
        <div>
        <h2>{{ $post->title }}</h2>
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

    
@endif

@endsection