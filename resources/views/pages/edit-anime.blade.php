@extends('layouts.app')

@section('title', 'Edit Anime')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Edit Anime</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('updateAnime', ['id' => $anime->id]) }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Anime Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $anime->title }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control">{{ $anime->description }}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label for="photo">Photo</label>
                            <input  name="photo" class="form-control" value="{{ $anime->photo }}">
                        </div>

                        <button type="submit" class="btn btn-success">Update Anime</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
