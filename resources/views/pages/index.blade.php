<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'CourseGuru') }}</title>

    <!-- Styles -->
    <style>
        body {
            background: url("/images/intro.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
            height:100%;        
        }

    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="jumbotron">
                <h1 class="text-center">Welcome to CourseGuru!</h1>
                <p class="text-center">Here you can find a variety of courses to enroll in. Let's get you started!</p>
                @if(Auth::check())
                <div class="text-center">
                        <a href="/courses" class="btn btn-default center">Get Started</a>
                </div>
                @else
                <div class="text-center">
                        <a href="/courses" class="btn btn-primary">Get Started</a>
                        or
                        <a href="{{ route('login') }}" class="btn btn-default">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-default">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
