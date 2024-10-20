@extends("layouts.master")


@section("content")
<div class="h-75 row align-items-center">
    <div class="col">
        <h1 class="text-center">Toogle</h1>
        <div class="text-center">The tagged post website</div>
        <form class="form-group" action="/tags" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search for a tag">
                <button class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <p class="text-center"><a href="/tags">Or pick something random</a></p>
        <p class="text-center"><a href="/search">Full search</a></p>

    </div>
</div>

<p> {{ $qod }} - From <a href="https://theysaidso.com/">theysaidso.com</a></p>
@endsection