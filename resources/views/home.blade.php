@extends('layouts.app')

@section('title', 'Anime Website')

@section('content')


    <div style="margin-top:100px; margin-bottom:100px">
        @if(session()->has('success'))
            <div class="alert alert-success" x-data="{show:true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" >
                {{session()->get('success')}}
            </div>
        @endif
        @if(session()->has('error'))
        <div class="alert alert-danger" x-data="{show:true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" >
            {{session()->get('error')}}
        </div>
        @endif

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


    @php
        $animes = [
            [
                'title' => 'Anime Title 1',
                'description' => 'Description of Anime 1. A short overview of the story or plot.',
                'image' => 'placeholder.svg'
            ],
            [
                'title' => 'Anime Title 2',
                'description' => 'Description of Anime 2. A short overview of the story or plot.',
                'image' => 'placeholder.svg'
            ],
            [
                'title' => 'Anime Title 3',
                'description' => 'Description of Anime 3. A short overview of the story or plot.',
                'image' => 'placeholder.svg'
            ],
        ];
    @endphp

    @foreach ($animes as $anime)
        <div class="col-md-4"> 
            <div class="card mb-4"> 
                <img src="{{ $anime['image'] }}" class="card-img-top" alt="{{ $anime['title'] }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $anime['title'] }}</h5>
                    <p class="card-text">{{ $anime['description'] }}</p>
                    <a href="{{route('animePage')}}" class="btn btn-primary">Watch Now</a>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('contentNews')

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
