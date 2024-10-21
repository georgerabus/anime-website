@extends('layouts.app')
@section('title', $anime->title)

@section('animePage')

<div class="container-fluid" style="margin-top: 20px">
    <div class="content">
        <div class="episode-list p-3" style="margin-top: 42px;">
            <h4>Episode List</h4>
            <ul class="list-group">
                @foreach ($anime->episodes as $episode)
                <a href="{{ route('animePage', ['id' => $anime->id, 'episode_id' => $episode->id]) }}" 
                    class="btn {{ $currentEpisode->id == $episode->id ? 'btn-primary' : 'btn-secondary' }}">
                    @if (!empty($episode->episode_title))
                    {{$episode->episode_title}}
                    @else
                    Episode {{ $episode->episode_id }}
                    @endif
                </a>
            @endforeach
            </ul>
        </div>

        <div class="canvas-container d-flex justify-content-center align-items-center">
            <div id="canvas">
                @if($currentEpisode)
                    <video width="1036" height="578" controls id="videoPlayer">
                        <source src="{{ $currentEpisode->episode }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>  
                @endif                
            </div>
        </div>

        <div class="about-section p-3" style="margin-top: 42px;">
            <h4>About</h4>
            <p>{{ $anime->description }}</p>
        </div>
    </div>
    @include('partials.comments')

</div>

<script>
    function loadEpisode(videoUrl) {
        var videoPlayer = document.getElementById('videoPlayer');
        videoPlayer.src = videoUrl;
        videoPlayer.load();
        videoPlayer.play();
    }
</script>

@endsection
