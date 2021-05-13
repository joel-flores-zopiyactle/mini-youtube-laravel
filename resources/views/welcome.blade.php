<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
       <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="nav">
        <div class="container">
            @if (Route::has('login'))
                <div class="d-flex justify-content-end">
                    @auth
                        <a href="{{ url('/home') }}" class="nav-link">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-link">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="container mx-auto h-full d-flex justify-content-center align-items-center">
                <div class="mt-5">
                    <h2 class="diplay-3">Encuestra los mejores videos</h2>
                    <p class="w-50">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam ipsum consectetur ut voluptatum debitis dolor, nihil tempora quasi magni. Perspiciatis laborum veritatis ducimus quas. Ducimus, molestias maxime nobis, dolores esse alias, eos voluptatibus placeat assumenda expedita tempora fugit dolore aspernatur enim perspiciatis non totam repudiandae?
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>
