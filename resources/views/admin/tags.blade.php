@extends("layouts.master")

@section("content")
<h1> Tags </h1>
<hr>

<form  method="POST" action="{{route("admin.tags.store")}}">
    @csrf
    <input name="tag" />
    <input type="submit" value="Make"/>
</form>

<form method="POST" action="{{route("admin.tags.destroy")}}">
    @csrf
    <input name="tag" />
    <input type="submit" value="Delete"/>
</form>

@foreach ($tags as $tag)

<li>{{ $tag->tag }}</li>

@endforeach
@endsection