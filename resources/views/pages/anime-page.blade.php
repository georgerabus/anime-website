@extends('layouts.app')
@section('title', 'Anime name placeholder')

@section('animePage')

<div class="container-fluid" style="margin-top: 20px">
    <div class="content">
        <div class="episode-list p-3" style="margin-top: 42px; ">
            <h4>Episode List</h4>
            <ul class="list-group">
                <li class="list-group-item">Episode 1</li>
                <li class="list-group-item">Episode 2</li>
                <li class="list-group-item">Episode 3</li>
                <li class="list-group-item">Episode 4</li>
                <li class="list-group-item">Episode 5</li>
            </ul>
        </div>

        <div class="canvas-container d-flex justify-content-center align-items-center">
            <div id="canvas">
                <!-- Here the show will play -->
                <video width="1036" height="578" controls>
                    <source  type="video/mp4"> <!-- https://e9.animeheaven.me/video.mp4?16d4940da72e912ecef5b9e18f9af2d1 -->
                    Your browser does not support the video tag.
                </video>                    
            </div>
        </div>

        <div class="about-section p-3" style="margin-top: 42px; ">
            <h4>About</h4>
            <p>This section contains information about the anime series. You can include details such as the synopsis, character descriptions, and any other relevant information.</p>
        </div>
    </div>
    @include('partials.comments')

</div>

@endsection