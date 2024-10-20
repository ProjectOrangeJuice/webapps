@extends("layouts.master")


@section("content")
<h1> {{ $tag->tag ?? "Oops!" }}</h1>
<hr>
@if (count($posts ?? []) === 0)
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li> {{ $error }}
            @endforeach
        </div>
    @else
        <p>No posts found for this tag!</p>
    @endif
    
@else
    @foreach ($posts as $post)
        <h2>{{ $post->title }}</h2>
        <h5> By {{ $post->user->name }} </h5>
        <p>{{ Str::limit($post->content,250,"...") }}</p>
        
    @endforeach
@endif

@endsection