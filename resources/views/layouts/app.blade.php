<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SportPlay') }}</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset("css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{asset("css/all.min.css")}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="http://www.utmachala.edu.ec/portalwp/wp-content/uploads/2015/08/LOGO_OUT.png" width="30" height="30" class="d-inline-block align-top" alt="">
                    {{ config('app.name', 'SportPlay') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @auth

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Crear Torneo
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
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
                                </div>
                            </li>
                            <li class="nav-item">

                            </li>

                            <li class="nav-item">
                                <a href="{{ route("team.index") }}" class="nav-link">Equipos/Jugadores</a>
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    @yield('script')

    <script>
        document.addEventListener("DOMContentLoaded", ()=>{
            document.querySelector('.navbar-toggler').addEventListener('click', responsiveMenu);
            document.querySelector('html').addEventListener('click', (e)=>{
                if (e.srcElement.classList.contains("dropdown-toggle")){
                    e.preventDefault();
                    openDrop(e.srcElement.parentElement)
                }
                else{
                    document.querySelector('.navbar-collapse').classList.remove('show');
                    closeDrop();
                }
            })
        });

        function responsiveMenu(e) {
            e.preventDefault();
            e.stopPropagation();
            let nav = this.parentElement.querySelector('.navbar-collapse');
            if (nav.classList.contains('show')){
                nav.classList.remove('show');
            }else{
                nav.classList.add('show');
            }
        }

        function openDrop(submenu){

            submenu = submenu.querySelector('.dropdown-menu');
            if (submenu.classList.contains('show')) {
                submenu.classList.remove('show');
            }
            else {
                closeDrop();
                submenu.classList.add('show');
            }
        }

        function closeDrop(){
            let menu = document.getElementsByClassName('dropdown-menu');
            for (let i=0; i<menu.length; i++){
                if (menu[i].classList.contains("show"))
                    menu[i].classList.remove("show");
            }
        }
    </script>
</body>
</html>
