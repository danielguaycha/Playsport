<section class="widget-nav">
    {{--FUTBOL--}}
    @if($tournament->sports_id == 1)
        <div class="widget-nav-logo">
            <i class="fa fa-futbol"></i>
            <span>{{ $tournament->name }}</span>
        </div>
        <div class="widget-nav-menu">
            <ul>
                <li><a href="{{ route('torneo.times', ['id'=> $tournament->id ]) }}">Fechas</a></li>
                <li><a href="{{route('torneo.stats', ['id'=>$tournament->id]) }}">Estadistica</a></li>
                <li><a href="{{route('torneo.grupos', ['id'=>$tournament->id])}}">Resultados</a></li>
                @foreach($pages as $p)
                    <li><a href="{{ route('torneo.page', ['id'=> $tournament->id, 'page'=> $p->url]) }}">{{$p->title}}</a></li>
                @endforeach
            </ul>
        </div>

    {{--FUTSAL--}}
    @elseif ($tournament->sports_id == 4)
        <div class="widget-nav-logo">
            <i class="fa fa-volleyball-ball"></i>
            <span>{{ $tournament->name }}</span>
        </div>
        <div class="widget-nav-menu">
            <ul>
                <li><a href="{{ route('torneo.times', ['id'=> $tournament->id ]) }}">Fechas</a></li>
                <li><a href="{{route('torneo.stats', ['id'=>$tournament->id]) }}">Estadistica</a></li>
                <li><a href="{{route('torneo.grupos', ['id'=>$tournament->id])}}">Resultados</a></li>
                @foreach($pages as $p)
                    <li><a href="{{ route('torneo.page', ['id'=> $tournament->id, 'page'=> $p->url]) }}">{{$p->title}}</a></li>
                @endforeach
            </ul>
        </div>
    @endif
</section>

