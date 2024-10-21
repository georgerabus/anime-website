@extends('layouts.app')
@section('title', 'Admin Page')

@section('content')
<div class="container" style="margin-top:80px">
    <div class="d-flex justify-content-center">
        <div class="btn-group" role="group" aria-label="User Actions">
            <a href="{{ route('adminAddNew') }}" class="btn btn-primary">Add New</a>
            <a href="{{ route('adminList') }}" class="btn btn-secondary">View List</a>
            <a href="{{ route('adminEditUser') }}" class="btn btn-warning">Edit Users</a>
        </div>
    </div>
</div>
@endsection
