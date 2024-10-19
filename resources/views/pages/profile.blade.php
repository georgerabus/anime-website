@extends('layouts.app')

@section('title', 'Edit User')

@section('profile')
<div class="container">
    <div style="margin-top: 70px">
        <h2>Profile Settings</h2>
        @if(session()->has('success'))
            <div class="alert alert-success" x-data="{show:true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" >
                {{session()->get('success')}}
            </div>
        @endif
        <form action="{{ route('profile-update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group mt-3">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <small class="form-text text-muted">Leave blank if you don't want to change the password</small>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group mt-3">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                @error('password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>            

            <div class="form-group mt-3">
                <label for="photo">Profile Photo</label>
                <input type="file" name="photo" id="photo" class="form-control-file">
                @error('photo')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-3">
                @if (auth()->user()->photo)
                    <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Profile Picture" class="img-fluid" style="max-width: 150px;">
                @else
                    <img src="{{ asset('default_photo.jpeg') }}" alt="Default Profile Picture" class="img-fluid" style="max-width: 150px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary mt-4">Update Profile</button>
        </form>
    </div>
</div>


@endsection
