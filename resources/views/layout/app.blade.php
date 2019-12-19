<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Beer Pairings</title>

    <meta name="description" content="Beer Pairings">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="min-h-screen flex flex-col">
        <div class="container flex-1">
            <div>
                <div class="text-center mt-12 text-4xl">
                    <i class="far fa-beer"></i>
                    <i class="far fa-hamburger"></i>
                </div>
                <h1 class="text-center mt-4 mb-8 text-2xl">
                    <a href="/">Beer Pairings</a>
                </h1>
            </div>

            @yield('content')
        </div>

        <div class="container py-8 text-sm">
            <div class="text-center">
                <div class="mt-3 md:mt-0">
                    &copy; {{ date('Y') }} William Youmans
                </div>
            </div>
        </div>
    </div>
</body>
</html>
