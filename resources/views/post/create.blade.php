@extends("layouts.master")

@section("content")
<script>var editCode = {{ $post }};
var postDataLink = {{ route("post.data",["id"=> $post]); }}
var postLink = {{ route("post.update"); }}
var postDeleteLink = {{ route("post.delete",["id"=>$post]); }}
var imagesLink = {{ route("image.upload"); }}</script>
<div id="app">
<posteditor></posteditor>
</div>




@endsection