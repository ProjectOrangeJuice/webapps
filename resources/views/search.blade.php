@extends("layouts.master")


@section("content")
<div class="h-75 row align-items-center">
    <div class="col">
        <h1 class="text-center">Some name</h1>
        <form class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for a tag">
                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <p class="text-center"><a href="ds">Or pick something random</a></p>

    </div>
</div>


@endsection