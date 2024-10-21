@extends('layouts.app')

@section('title', 'Anime List')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Anime List</h4>
                </div>
                <div class="card-body">
                    @if ($animes->isEmpty())
                        <p class="text-center">No anime found.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($animes as $anime)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{ route('adminListEpisodes', ['id' => $anime->id]) }}" class="text-decoration-none">
                                        {{ $anime->title }}
                                    </a>
                                    <div>
                                        <a href="{{ route('editAnime', ['id' => $anime->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('deleteAnime', ['id' => $anime->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this anime?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
