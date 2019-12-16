@extends("layouts.master")

@section("content")
<script>var editCode = {{ $post }};</script>
<div id="app">
<posteditor></posteditor>
</div>




@endsection