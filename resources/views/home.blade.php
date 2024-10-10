@extends('layouts.app')

@section('title', 'Anime Website')

@section('content')


<div style="margin-top:100px; margin-bottom:100px">
    <div class="jumbotron text-center">
        <h1>Welcome to Anime Website</h1>
        <p>Explore the world of anime. Watch your favorites and discover new series!</p>
        <form action="{{ url('/search') }}" method="GET" class="d-flex justify-content-center">
            <input type="text" name="query" class="form-control w-50" placeholder="Search for anime...">
            <button type="submit" class="btn btn-primary ms-2">Search</button>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center my-4 mt-5">Featured Anime</h2>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="placeholder.svg" class="card-img-top" alt="Anime 1">
                <div class="card-body">
                    <h5 class="card-title">Anime Title 1</h5>
                    <p class="card-text">Description of Anime 1. A short overview of the story or plot.</p>
                    <a href="#" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="placeholder.svg" class="card-img-top" alt="Anime 2">
                <div class="card-body">
                    <h5 class="card-title">Anime Title 2</h5>
                    <p class="card-text">Description of Anime 2. A short overview of the story or plot.</p>
                    <a href="#" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <img src="placeholder.svg" class="card-img-top" alt="Anime 3">
                <div class="card-body">
                    <h5 class="card-title">Anime Title 3</h5>
                    <p class="card-text">Description of Anime 3. A short overview of the story or plot.</p>
                    <a href="#" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('content-news')

<div class="container my-5">
    <h1 class="text-center mb-4">Latest News</h1>
    <div class="row">
        {{-- @foreach($newsItems as $news)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $news->image_url }}" class="card-img-top" alt="{{ $news->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $news->title }}</h5>
                        <p class="card-text">{{ Str::limit($news->description, 100) }}</p>
                        <a href="{{ route('news.show', $news->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach --}}
        @for ($i = 0; $i < 5; $i++)
            <p>Blah Blah Blah</p>
        @endfor
    </div>
</div>
@endsection
