@extends('layouts.app')

@section('title', 'Edit Episode')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Episode</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateEpisode', ['id' => $episode->anime_id, 'episode_id' => $episode->id]) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="episode">Episode Title</label>
                            <input type="text" name="episode_title" class="form-control" value="{{ $episode->episode_title }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="episode">Episode URL</label>
                            <input  name="episode" class="form-control" value="{{ $episode->episode }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="episode_id">Episode ID</label>
                            <input type="number" name="episode_id" class="form-control" value="{{ $episode->episode_id }}" required>
                        </div>

                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
