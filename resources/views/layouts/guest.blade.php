<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#24292e">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#24292e">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#24292e">

    @yield('style')
</head>
<body>

<header>
    <div class="logo">
        <a href="{{ url('/') }}" class="logo-image"><img src="{{ asset('img/logo.png') }}" width="40px">
            AdminSport
        </a>
        <button onclick="menu()" class="open-menu"><i class="fa fa-bars"></i></button>
    </div>
    <nav class="menu-main">
        @yield('menu')
        <ul class="menu">
            {{-- <li><a href="{{ url('premios') }}">Premios</a></li>
             <li><a href="{{ url('reglas') }}">Reglas</a></li>--}}

            {{--<li><a href="#">Noticias</a></li>--}}
        </ul>

        <ul class="socials" style="flex: 0;">
            <ul>
                <li>
                    @auth
                        <a href="{{ url('/admin') }}">Admin</a>
                    {{--@else
                        <a href="{{ route('login') }}">Login</a>

                        --}}{{-- @if (Route::has('register'))
                             <a href="{{ route('register') }}">Register</a>
                         @endif--}}
                    @endauth
                </li>
            </ul>
        </ul>
    </nav>
    <div class="overlayer" onclick="menu()"></div>
</header>

@yield('content')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
@yield('script')
<script>
    function menu(){
        let menu = document.querySelector('.menu-main');
        let overlayer = document.querySelector('.overlayer');
        if(menu.classList.contains("open")){
            menu.classList.remove("open");
            overlayer.classList.remove('open');
        }else{
            menu.classList.add("open");
            overlayer.classList.add('open');
        }
    }

    window.onresize = function(event) {
        let menu = document.querySelector('.menu-main');
        if(menu.classList.contains("open")) {
            menu.classList.remove("open");
            document.querySelector('.overlayer').classList.remove('open');
        }
    };

</script>
</body>
</html>