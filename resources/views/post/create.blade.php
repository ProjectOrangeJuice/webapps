@extends("layouts.master")

@section("content")
<script>var editCode = {{ $post }};
var postLink = "{{ route("post.update") }}";
var imagesLink = "{{ route("image.upload") }}";</script>
<div id="app">
<posteditor></posteditor>
</div>




@endsection