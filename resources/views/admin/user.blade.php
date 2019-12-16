@extends("layouts.master")

@section("content")
<h1> User account </h1>
<hr>
<script>
var user = @json($user);
var tagsj = @json($user->admins);
    </script>
<div id="app">
<adminuser><adminuser>
</div>

@endsection