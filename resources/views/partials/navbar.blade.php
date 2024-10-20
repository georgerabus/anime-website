<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Anime Website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('anime-list') }}">Anime List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact')}}">Contact</a>
                </li>
                @if(!Auth::user())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Log in</a>
                </li>
                @endif
                @if(Auth::user())
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user-profile')}}">Edit Profile</a>
                </li>
                <li class="nav-item" style="padding-inline: 7px">
                    <a class="nav-link" href="#" 
                       onclick="event.preventDefault(); document.getElementById('submit-form').submit();">
                       <i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                </li>
                
                <form id="submit-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>
                @endif
            </ul>
        </div>
    </div>
</nav>
    