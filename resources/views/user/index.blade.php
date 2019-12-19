@extends("layouts.master")

@section("content")


<h1>Your account</h1>
<div class="row">

<div class="col-7">
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
    
    @if ($errors->any())
    <div class="alert alert-danger">
        Errors! 
        <ul>
            @foreach ($errors->all() as $error)
            
            <li> {{ $error }}</li>
            @endforeach
            

        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route("account.update")}}">
        @csrf
        <div class="form-group">
            Username: {{$user->name}}
          </div>
          <div class="form-group">
        Current password: <input type="password" name="password">
    </div>
        <div class="form-group">
        New password: <input type="password" name="new-password">
    </div>
    <div class="form-group">
        Email: <input type="text" name="email" value="{{$user->email}}">
    </div>
    <div class="form-group">
        Tags you admin:   @foreach($user->admins as $tag)
          <a href="{{route ("tag.mod",["tag"=>$tag->id])}}" > 
            {{ $loop->first ? '' : "," }}
            {{ $tag->tag }}
          </a>
            @endforeach
        </div>
       <input type="submit" value="save">
    </form>

    <script>
        var notepad = "{{route("notepad")}}";
        </script>
    <div id="app">
        <notepad></notepad>
        </div>
        
</div>



</div>

@endsection

