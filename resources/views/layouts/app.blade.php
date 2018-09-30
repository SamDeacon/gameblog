<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <style>
        html, body {
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        /* .full-height {
            height: 100vh;
        } */

        .flex-center {
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content-laravelwelcome{
            text-align: center;
            border: 1px solid black;
            width: 100%;
            background: #fff;
        }


        .links > a, .header a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .header{
          height: 100px;
        }
        img.big-mofo-img{
          max-width: 100%;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="">
            <div class="container">

            </div>
        </nav>


    <body class="bg-black">


      <header class="header">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        @if (Route::has('login'))
              <div class="top-right links">
                  @auth
                      <a href="{{ url('#') }}">Messages</a>
                      <a href="{{ url('admin/dashboard') }}">Dashboard</a>
                      <a href="{{ route('logout') }}">Logout</a>
                  @else
                      <a href="{{ route('login') }}">Login</a>
                      <a href="{{ route('register') }}">Register</a>
                  @endauth
              </div>
          @endif
      </header>
      <main class="py-4">
          @yield('content')
      </main>

    </body>
</html>
