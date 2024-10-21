@extends('layouts.app')

@section('title', 'Episode List')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Episode List</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group mb-3">

                    @if ($anime->episodes->isNotEmpty())
                        @foreach ($anime->episodes as $ep)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>
                                @if (!empty($ep->episode_title))
                                {{$ep->episode_title}}
                                @else
                                Episode {{ $ep->episode_id }}
                                @endif
                            </span>
                                <div>
                                    <a href="{{ route('editEpisode', ['id' => $anime->id, 'episode_id' => $ep->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('deleteEpisode', ['id' => $anime->id, 'episode_id' => $ep->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                    
                                    
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    


                    @else
                        <div class="alert alert-warning">No episodes available</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
