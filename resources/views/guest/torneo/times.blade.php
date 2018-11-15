@extends('layouts.guest')

@section('content')

    <main class="content-max">
        @include('guest.torneo.partials._futbol', $tournament)

        @if(count($time_groups)>0)
            <div class="group-body">
                <div class="group-title">
                    <span>
                        @if($groups_num > 1)
                            Fase de Grupos | Calendario
                        @else
                            {{ ($time_groups[0]->group) }} | Calendario
                        @endif
                    </span>
                    <span>
                        @if(!request('order'))
                            <a href="{{ route('torneo.times', ['url'=>$tournament->url,'order'=>'group']) }}"
                               class="btn primary">
                                <i class="fa fa-object-group"> </i>
                                <span class="movil-hide">&nbsp;Agrupar</span>
                            </a>
                        @else
                            <a href="{{ route('torneo.times', ['url'=> $tournament->url]) }}"
                               class="btn primary">
                                <i class="fa fa-list"> </i>&nbsp;
                                <span class="movil-hide">&nbsp;Listar</span>
                            </a>
                        @endif
                    </span>
                </div>
                @if(!request("order"))
                    <div class="table-responsive">
                    <table class="table table-hover">
                    <tbody>
                    <tr class="table-row-title">
                        <th class="movil-hide">#</th>
                        <th class="text-left"  @if($groups_num == 1) style="display: none;" @endif>Grupo</th>
                        <th>Equipo A</th>
                        <th class="text-center movil-hide">/</th>
                        <th>Equipo B</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        @auth
                            <th>Acción</th>
                        @endauth
                    </tr>
                    @php
                        $i = 1;
                        $tmpDate = null;
                    @endphp
                    @foreach($time_groups as $g)
                            <tr>
                            <td width="1%" class="movil-hide">{{ $i }}</td>
                            <td width="10%" @if($groups_num == 1) style="display: none;" @endif>{{$g->group}}</td>
                            <td class="text-center" width="30%">
                                @if($g->type_a == 'Male')
                                    <img src="{{ Avatar::create($g->alias_a)->setBackground($g->logo_a)->toBase64() }}" width="30px"/>
                                @else
                                    <img src="{{ Avatar::create($g->alias_a)
                                                ->setBorder(5, "#C2185B")
                                                ->setBackground($g->logo_a)->toBase64() }}" width="30px"/>
                                @endif


                            </td>
                            <td class="text-center movil-hide" width="1%">vs</td>
                            <td class="text-center" width="30%">
                                @if($g->type_b == 'Male')
                                    <img src="{{ Avatar::create($g->alias_b)->setBackground($g->logo_b)->toBase64() }}" width="30px"/>
                                @else
                                    <img src="{{ Avatar::create($g->alias_b)
                                                ->setBorder(5, "#C2185B")
                                                ->setBackground($g->logo_b)->toBase64() }}" width="30px"/>
                                @endif
                            </td>
                            <td class="text-center" width="15%">
                                {{ $g->date }}
                            </td>
                            @if($tournament->sports_id == 3)
                                @if($i == 1)
                                    <td class="text-center" width="5%">{{ substr($g->hour, 0, 5) }}</td>
                                @else
                                    <td class="text-center" width="5%">--:--</td>
                                @endif
                            @else
                                <td class="text-center" width="5%">{{ substr($g->hour, 0, 5) }}</td>
                            @endif
                            @auth
                                <td>
                                    <a href="{{ route('result.edit', ['id'=> $g->id]) }}"><i class="fa fa-play"></i></a>
                                    <a href="{{ route('timetable.edit', ['id'=> $g->id, 'group_id'=> $g->group_id ]) }}">
                                        <i class="fa fa-clock"></i>
                                    </a>
                                </td>
                            @endauth
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
                </div>
                @else
                    @foreach($groups as $g)
                        <div class="group-content">
                            @if($groups_num > 1)
                            <div class="group-title">
                                {{ $g->name }}
                            </div>
                            @endif
                            <div class="matches-content">
                                @foreach($time_groups as $i=>$tg)

                                    @if($g->name == $tg->group)
                                        <a @auth href="{{route('result.edit', ['id'=> $tg->id])}}" @endauth>
                                            <div class="teams">
                                                {{--Team A--}}
                                                <div
                                                    @if($tg->result_a !=null)
                                                        @if($tg->result_a>$tg->result_b)
                                                            class="winner"
                                                        @elseif($tg->result_a==$tg->result_b)
                                                            class="par"
                                                        @else
                                                            class="lose"
                                                        @endif
                                                    @endif>
                                                    @if($tg->type_a == 'Male')
                                                        <img src="{{ Avatar::create($tg->alias_a)->setBackground($tg->logo_a)->toBase64() }}" width="30px"/>
                                                    @else
                                                        <img src="{{ Avatar::create($tg->alias_a)
                                                        ->setBackground($tg->logo_a)
                                                        ->setBorder(5, "#C2185B")
                                                        ->setBackground($tg->logo_a)->toBase64() }}" width="30px"/>
                                                    @endif
                                                    <span>{{ $tg->team_a }}</span>
                                                    <div>{{ $tg->result_a==null?'0':$tg->result_a }}</div>
                                                </div>
                                                {{--Team B--}}
                                                <div
                                                    @if($tg->result_b !=null)
                                                        @if($tg->result_b>$tg->result_a)
                                                        class="winner"
                                                        @elseif($tg->result_a==$tg->result_b)
                                                        class="par"
                                                        @else
                                                        class="lose"
                                                        @endif
                                                    @endif>
                                                    @if($tg->type_b == 'Male')
                                                        <img src="{{ Avatar::create($tg->alias_b)->setBackground($tg->logo_b)->toBase64() }}" width="30px"/>
                                                    @else
                                                        <img src="{{ Avatar::create($tg->alias_b)
                                                            ->setBorder(5, "#C2185B")
                                                            ->setBackground($tg->logo_b)->toBase64() }}" width="30px"/>
                                                    @endif
                                                    <span>{{ $tg->team_b }}</span>
                                                    <div>{{ $tg->result_b==null?'0':$tg->result_b }}</div>
                                                </div>
                                            </div>
                                            <div class="date">
                                                @if($tg->status == -1)
                                                    @if($tournament->sports_id == 3)
                                                        <span>{{ $tg->date }}</span>
                                                        <span>--:--</span>
                                                    @else
                                                        <span>{{ $tg->date }}</span>
                                                        <span>{{ $tg->hour }}</span>
                                                    @endif
                                                @elseif($tg->status == 0)
                                                    <span>En proceso</span>
                                                @elseif($tg->status == 1)
                                                    <span>Finalizado</span>
                                                @endif
                                                <!--  <span class="status">Finalizado</span> -->
                                            </div>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </main>
@endsection