@extends('layouts.guest')

@section('content')
<main class="content">
    <div class="main-title liner mb-2">
            <span class="text">
                Juegos deportivos &nbsp;Escuela Informática&nbsp; 2018
            </span>
    </div>
    {{--<!-- Teams -->--}}
    <div class="main-players container mb-1">
        <div class="row">
            <div class="col main-teams">
                <ul class="main-teams-left">
                </ul>
            </div>
            {{--<!-- Copa -->--}}
            <div class="col-2 main-coup">
                <div class="team-start">
                    <i class="fa fa-star"></i>
                </div>
            </div>

            <div class="col main-teams">
                <ul class="main-teams-right">
                </ul>
            </div>
        </div>

    </div>
    {{--<!-- Sports -->--}}
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="sport-widget">
                    <div class="sport-widget-main">
                        <a href="{{ url('/futbol') }}">
                            <div class="sport-widget-img">
                                <img src="{{ asset('img/home/futbol.png') }}" alt="Futbol">
                            </div>
                            <span>
                                    Fútbol Maculino
                                </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="sport-widget sport-widget-hover">
                    <div class="sport-widget-main">
                        <div class="sport-widget-img">
                            <img src="{{asset('img/home/basquet.png')}}" alt="Futbol">
                        </div>
                        <span>
                                Basquet Maculino & Femenino
                            </span>
                        <div class="sport-widget-footer">
                            <i class="fa fa-plus-circle"></i>
                        </div>
                    </div>
                    <div class="sport-widget-detail">
                        <ul>
                            <li><a href="{{ url('basket-m') }}"><i class="fa fa-futbol">&nbsp;&nbsp;</i>Basket Masculino</a></li>
                            <li><a href="{{ url('basket-f') }}"><i class="fa fa-futbol">&nbsp;&nbsp;</i>Basket Femenino</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="sport-widget">
                    <div class="sport-widget-main">
                        <a href="{{ url('ecuavolley') }}">
                            <div class="sport-widget-img">
                                <img src="{{asset("img/home/volley.png")}}" alt="Futbol">
                            </div>
                            <span>
                                    Volley Maculino
                                </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="sport-widget">
                    <div class="sport-widget-main">
                        <a href="{{ url('futsal') }}">
                            <div class="sport-widget-img">
                                <img src="{{asset("img/home/futsal.png")}}" alt="Futbol">
                            </div>
                            <span>
                                    Futsal Femenino
                                </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--<!-- Events -->--}}
    <div class="container events">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <a href="{{ url('/natacion') }}" class="event-widget">
                    <div class="e-w-icon-content natacion">
                        <div class="e-w-icon" id="natacion">  </div>
                    </div>
                    <div class="e-w-text">
                        Natación
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ url('/gincana') }}" class="event-widget">
                    <div class="e-w-icon-content gincana">
                        <div class="e-w-icon" id="gincana">

                        </div>
                    </div>
                    <div class="e-w-text">
                        Gincana
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ url('/postas') }}" class="event-widget">
                    <div class="e-w-icon-content postas">
                        <div class="e-w-icon" id="postas">

                        </div>
                    </div>
                    <div class="e-w-text">
                        Postas
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="{{ url('/cam-mojadas') }}" class="event-widget">
                    <div class="e-w-icon-content cam-mojadas">
                        <div class="e-w-icon" id="cam-mojadas">

                        </div>
                    </div>
                    <div class="e-w-text">
                        Cam. Mojadas
                    </div>
                </a>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
    <script>

        let left = document.querySelector('.main-teams-left');
        let right = document.querySelector('.main-teams-right');

        let letfTeams = {
            "1a": "",
            "1b": "#d85878",
            "2a": "#e4a561",
            "2b": "#1a73a5",
            "3a": "#0068D6",
            "4A": "#04948D",
        };

        let rightTeams = {
            "5a": "#52669a",
            "6a": "#17BAF4",
            "7a": "",
            "8a": "#f14742",
            "9a": "",
            "10a": "#0491ad"
        }

        createTeam(letfTeams, left);
        createTeam(rightTeams, right);

        function createTeam(teams, container) {
            for (var key in teams) {
                let el = document.createElement("LI");
                el.innerHTML = `<span>${key.toUpperCase()}</span>`;
                el.style.background = `${teams[key]}`;
                if (key.length > 2) {
                    el.style.padding = ".8rem 10px";
                }
                container.appendChild(el);
            }
        }
    </script>
@endsection