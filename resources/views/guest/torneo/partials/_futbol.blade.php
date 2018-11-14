<section class="widget-nav">
    {{--FUTBOL--}}
    @if($tournament->sports_id == 1)
        <div class="widget-nav-logo">
            <i class="fa fa-futbol"></i>
            <span>{{ $tournament->name }}</span>
        </div>
        <div class="widget-nav-menu">
            <ul>
                <li><a href="{{ route('torneo.times', ['url'=> $tournament->url ]) }}">Fechas</a></li>
                <li><a href="{{route('torneo.grupos', ['url'=>$tournament->url])}}">Resultados</a></li>
                <li><a href="{{route('torneo.final', ['url'=>$tournament->url])}}">Etapa Final</a></li>
                <li><a href="{{route('torneo.stats', ['url'=>$tournament->url]) }}">Estadistica</a></li>

                @foreach($pages as $p)
                    <li><a href="{{ route('torneo.page', ['url'=> $tournament->url, 'page'=> $p->url]) }}">{{$p->title}}</a></li>
                @endforeach
            </ul>
        </div>

    {{--FUTSAL--}}
    @elseif ($tournament->sports_id == 4)
        <div class="widget-nav-logo">
            <i class="fa fa-basketball-ball"></i>
            <span>{{ $tournament->name }}</span>
        </div>
        <div class="widget-nav-menu">
            <ul>
                <li><a href="{{ route('torneo.times', ['url'=> $tournament->url ]) }}">Fechas</a></li>
                <li><a href="{{route('torneo.grupos', ['url'=>$tournament->url])}}">Resultados</a></li>
                <li><a href="{{route('torneo.final', ['url'=>$tournament->url])}}">Etapa Final</a></li>
                <li><a href="{{route('torneo.stats', ['url'=>$tournament->url]) }}">Estadistica</a></li>
            @foreach($pages as $p)
                    <li><a href="{{ route('torneo.page', ['url'=> $tournament->url, 'page'=> $p->url]) }}">{{$p->title}}</a></li>
                @endforeach
            </ul>
        </div>

    {{-- BASKET --}}
    @elseif ($tournament->sports_id == 2)
        <div class="widget-nav-logo">
            <i class="fa fa-baseball-ball"></i>
            <span>{{ $tournament->name }}</span>
        </div>
        <div class="widget-nav-menu">
            <ul>
                <li><a href="{{ route('torneo.times', ['url'=> $tournament->url ]) }}">Fechas</a></li>
                <li><a href="{{route('torneo.grupos', ['url'=>$tournament->url])}}">Resultados</a></li>
                <li><a href="{{route('torneo.final', ['url'=>$tournament->url])}}">Etapa Final</a></li>
                {{--<li><a href="{{route('torneo.stats', ['url'=>$tournament->url]) }}">Estadistica</a></li>--}}
            @foreach($pages as $p)
                    <li><a href="{{ route('torneo.page', ['url'=> $tournament->url, 'page'=> $p->url]) }}">{{$p->title}}</a></li>
                @endforeach
            </ul>
        </div>
    @elseif($tournament->sports_id == 3)
        <div class="widget-nav-logo">
            <i class="fa fa-volleyball-ball"></i>
            <span>{{ $tournament->name }}</span>
        </div>
        <div class="widget-nav-menu">
            <ul>
                <li><a href="{{ route('torneo.times', ['url'=> $tournament->url ]) }}">Fechas</a></li>
                <li><a href="{{route('torneo.grupos', ['url'=>$tournament->url])}}">Resultados</a></li>
                <li><a href="{{route('torneo.final', ['url'=>$tournament->url])}}">Etapa Final</a></li>
                @foreach($pages as $p)
                    <li><a href="{{ route('torneo.page', ['url'=> $tournament->url, 'page'=> $p->url]) }}">{{$p->title}}</a></li>
                @endforeach
            </ul>
        </div>
    @endif
</section>

