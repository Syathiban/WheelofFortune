<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('GameofFortune', 'GameofFortune') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/game.js') }}" defer></script>
    <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    <script> 
 
    setTimeout(function() {
            $(".al").fadeOut();
            $(".failure").hide()
        }, 3000);
    
    </script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<style>

            .al {
                float: none;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 5px;
               /* background-image: linear-gradient(#30C2AF, #54D9C4);*/
                background-color: #ededed ;
                color: #30C2AF;
                border-style: none;
                text-align: center;
                align: center;
                font-size: 15px;
                font-weight: bold;
            }

            .failure {
                float: none;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 5px;
                width: 220px;
               /* background-image: linear-gradient(#30C2AF, #54D9C4);*/
                background-color: #ededed;
                color: #ef535e;
                border-style: none;
                text-align: center;
                align: center;
                font-size: 15px;
                font-weight: bold;
            }
        </style>
</head>
<body class="bod">

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-fixed-top navbar-light navbar-laravel">
        
            <div class="container">
                <a class="navbar-brand" style="color: rgb(78, 76, 175);" href="{{ url('/home') }}">
                    {{ config('GameofFortune', 'GameofFortune') }}
                </a>
                <ul class="navbar-nav mr-auto">
                @if (Auth::check() && auth()->User()->actor == "admin")
                
                    <li class="nav-item"><a class="nav-link" href="/words">Words</a></li>
                    <li class="nav-item"><a class="nav-link" href="/questions">Questions</a></li>
                    <li class="nav-item"><a class="nav-link" href="/categories">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="/highscorelists">Highscores</a></li>
                @endif

                @If (Auth::check())
                <li class="nav-item"><a class="nav-link" href="/game">Game</a></li>

                @endif
                </ul>

                @if(Session::has('success'))
                <div class="expandable al alert alert-success">
                <span><i class="fa fa-check-circle" aria-hidden="true"></i></span>
                        {{ Session::get('success') }}
                </div>
                @endif

                @if(Session::has('fail'))
                <div class="failure alert alert-success">
                <span><i class="fa fa-times" aria-hidden="true"></i></span>
                        {{ Session::get('fail') }}
                </div>
                @endif

                @if(Session::has('authorise'))
                <div class="failure alert alert-success">
                <span><i class="fa fa-times" aria-hidden="true"></i></span>
                        {{ Session::get('authorise') }}
                </div>
                @endif
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" style="color: rgb(78, 76, 175);" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
</body>

</html>
