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
                    <form action="{{ route('updateAnime', ['id' => $anime->id]) }}" method="POST" enctype="multipart/form-data">
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
                            <div class="mt-3 mb-3">
                                <img id="image-preview" src="{{ asset('storage/' . $anime->photo) }}" alt="Anime Photo" class="img-fluid" style="max-width: 400px;">
                            </div>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>

                        <div class="form-group mb-3">
                            <label>
                                <input type="checkbox" name="delete_photo" value="1"> Delete current photo
                            </label>
                        </div>

                        <button type="submit" class="btn btn-success">Update Anime</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
