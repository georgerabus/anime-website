@extends('layouts.app')
@section('title', 'Admin Page')


@section('content')
<div class="container" style="margin-top:80px">
    <h1>Add New Anime</h1>
    @if(session()->has('success'))
    <div class="alert alert-success" x-data="{show:true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" >
        {{session()->get('success')}}
    </div>
    @endif

    <form action="{{ route('storeAnime') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Anime Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        <button type="submit" class="btn btn-primary">Add Anime</button>
    </form>

    <hr>

    <h1>Add New Episode</h1>

    <form action="{{ route('storeEpisode') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="anime_id" class="form-label">Select Anime</label>
            <select class="form-select" id="anime_id" name="anime_id" required>
                @foreach($animes as $anime)
                    <option value="{{ $anime->id }}">{{ $anime->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="episode_id" class="form-label">Episode ID</label>
            <input type="number" class="form-control" id="episode_id" name="episode_id" required>
        </div>
        <div class="mb-3">
            <label for="episode_title" class="form-label">Episode Title</label>
            <input type="text" class="form-control" id="episode_title" name="episode_title" placeholder="Optional Title">
        </div>
        <div class="mb-3">
            <label for="episode" class="form-label">Episode URL</label>
            <input type="text" class="form-control" id="episode" name="episode" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Episode</button>
    </form>
</div>
@endsection