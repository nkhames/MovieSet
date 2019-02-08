<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CineMap') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer></script>


    <script src="{{ asset('js/slider.js') }}"></script>
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    @stack('header')

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    MovieSet
                    <figure>
                        <img class="img-fluid" src="{{ asset('\custom\logo.png')}}" alt="logo">
                    </figure>

                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
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
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="{{ url('/test') }}" role="button" aria-haspopup="true" aria-expanded="false">Scènes de film</a>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/test') }}">Scènes proche de chez vous</a>
                            <a class="dropdown-item" href="{{ url('/PriseDeVues') }}">Les scènes</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/insert') }}">Ajouter une scène</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="{{ url('/MapLieux') }}" role="button" aria-haspopup="true" aria-expanded="false">Trouver son lieu de tournages</a>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ url('/MapLieux') }}">Lieux disponible proche de chez vous</a>
                            <a class="dropdown-item" href="{{ url('/annonces') }}">Les lieux de tournages à réserver</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/proposer') }}">Proposer son bien comme lieu de tournage</a>
                            </div>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="@stack('main_class')">
            @yield('content')
        </main>
    </div>
    <div
        style="position: relative;right: 0;bottom: 0;left: 0;padding: 1rem;background-color: #efefef;text-align: center;">
        <footer class="footer-copyright text-center py-3">
            <div id="copyright text-right">© Copyright 2019 CineMap <br> <a
                    href="{{ url('/Contact') }}">{{ __('Contact') }}</a> <br> <a
                    href="{{ url('/AboutUs') }}">{{ __('About Us') }}</a></div>
        </footer>
    </div>
    @stack('scripts')
</body>

</html>