<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SportAdmin') }}</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#24292e">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#24292e">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#24292e">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{asset("css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/jquery.toast.min.css")}}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="http://www.utmachala.edu.ec/portalwp/wp-content/uploads/2015/08/LOGO_OUT.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    {{ config('app.name', 'SportAdmin') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth

                            <li class="nav-item dropdown">
                                <a class="nav-link" href="{{ route("tournament.index") }}">
                                    Torneos
                                </a>
                                {{--<a class="nav-link dropdown-toggle" href="{{ route("tournament.index") }}" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Torneos
                                </a>--}}
                                {{--<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <h6 class="dropdown-header">1. Registrar Torneo</h6>
                                    <a href="{{ route("tournament.index") }}"
                                       class="dropdown-item">Nuevo Torneo</a>
                                    <h6 class="dropdown-header">2. Tipo de Toreno</h6>
                                    <a class="dropdown-item"
                                       href="{{route('group.create')}}">Crea grupos</a>
                                    <a class="dropdown-item"
                                       href="{{route('stage.create')}}">Crea eliminatoria</a>
                                    <h6 class="dropdown-header">3. Calendario</h6>
                                    <a class="dropdown-item"
                                       href="{{route('timetable.create')}}">Definir fechas</a>
                                </div>--}}
                            </li>
                            <li class="nav-item">

                            </li>

                            <li class="nav-item">
                                <a href="{{ route("team.index") }}" class="nav-link">Equipos/Jugadores</a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('page.index') }}" class="nav-link">Páginas</a>
                            </li>
                            {{--<li class="nav-item">
                                <a href="{{ route('player.index') }}" class="nav-link">Jugadores</a>
                            </li>--}}

                           {{-- <li class="nav-item">
                                <a href="#" class="nav-link">Horarios</a>
                            </li>--}}

                            <li class="nav-item">

                            </li>
                        @endauth
                       {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Valor
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>--}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                           {{-- <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>--}}
                        @else
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

        <main class="py-4" style="top: 0;">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script src="{{ asset('js/jquery.toast.min.js') }}"></script>
    <script>
        function ok(msg){
            $.toast({
                heading: 'Bien',
                text: msg,
                showHideTransition: 'slide',
                icon: 'success',
                position: 'bottom-right',
                loader: false
            })
        }
        $('.open-window').click(function (e) {
            e.preventDefault();
            window.open($(this).attr('href'), "Add", "width=800,height=600");
        });
        $('.btn-tooltip').tooltip();
        $('.form-confirm').submit(function (e) {
            e.preventDefault();
            let msg ="";
            if($(this).data('msg')){
                msg = $(this).data('msg');
            }else{
                msg ="¿Estás seguro de realizar esta operación?";
            }

            let c = confirm(msg);
            if(c) {
                document.getElementById($(this).attr('id')).submit();
            }

        })
    </script>
    @yield('script')

</body>
</html>
