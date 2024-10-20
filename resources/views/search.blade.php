@extends("layouts.master")


@section("content")
<div class="h-75 row align-items-center">
    <div class="col">
        <h1 class="text-center">Toogle</h1>
        <p class="text-center">Full search</p>
        <form class="form-group" action="/search" method="GET">
         
            <input type="text" class="form-control" name="tags" placeholder="Tags">
            <input type="text" class="form-control" name="users" placeholder="User names (comma to separate)">
            <div class="text-center">
                <button class="btn btn-primary"><b>Search </b><i class="fa fa-search"></i></button>
   </div>
        </form>
        <p class="text-center"><a href="{{ route("home") }}">Tag search</a></p>

    </div>
</div>


@endsection