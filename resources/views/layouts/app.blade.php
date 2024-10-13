<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Anime Website')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    @include('partials.navbar')

    @hasSection('content')
        <div class="container">
            @yield('content')
        </div>
    @endif

    @hasSection('animePage')
        <div>
            @yield('animePage')
        </div>
    @endif

    @hasSection('contentNews')
        <div class="container">
            @yield('contentNews')
        </div>
    @endif

    @hasSection('profile')
    <div class="container">
        @yield('profile')
    </div>
    @endif

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
