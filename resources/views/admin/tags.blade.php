@extends("layouts.master")

@section("content")
<h1> Tags </h1>
<hr>

<form  method="POST" action="/admin/tags/make">
    @csrf
    <input name="tag" />
    <input type="submit" value="Make"/>
</form>

<form method="POST" action="/admin/tags/delete">
    @csrf
    <input name="tag" />
    <input type="submit" value="Delete"/>
</form>

@foreach ($tags as $tag)

<li>{{ $tag->tag }}</li>

@endforeach
@endsection