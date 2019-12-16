@extends("layouts.master")

@section("content")
<h1> Tags </h1>
<hr>

<form>
    <input name="tag" method="POST" action="/admin/tags/make" />
    <input type="submit" value="Make"/>
</form>

<form>
    <input name="tag" method="POST" action="/admin/tags/delete"/>
    <input type="submit" value="Delete"/>
</form>

@foreach ($tags as $tag)

<li>{{ $tag->tag }}</li>

@endforeach
@endsection