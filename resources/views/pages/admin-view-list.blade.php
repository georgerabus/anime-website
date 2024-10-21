@extends('layouts.app')

@section('title', 'Anime List')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>Anime List</h4>
                </div>
            @foreach ($animes as $anime)
            <a href="{{route('adminListEpisodes', ['id' => $anime->id])}}">{{$anime->title}}</a>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection