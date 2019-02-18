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
                       {{-- @if(!request('order'))
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
                        @endif--}}
                    </span>
                </div>
                {{--@if(!request("order"))
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
                                    <img src="{{ asset($g->logo_a) }}" width="30px" class="rounded-circle"/>
                            </td>
                            <td class="text-center movil-hide" width="1%">vs</td>
                            <td class="text-center" width="30%">
                                <img src="{{ asset($g->logo_b) }}" width="30px" class="rounded-circle"/>
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
                @else--}}
                    @foreach($groups as $g)
                        <div class="group-content">
                            @if($groups_num > 1)
                            <div class="group-title">
                               <b>{{ $g->name }}</b>
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
                                                    <img src="{{ asset($tg->logo_a) }}" width="30px" class="rounded-circle"/>
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
                                                    <img src="{{ asset($tg->logo_b) }}" width="30px" class="rounded-circle"/>
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
               {{-- @endif--}}


            </div>
        @endif
        @if(count($league)>0)
            <div class="group-body">
            <div class="group-title">
                    <span>
                        {{ $league->name }}
                    </span>
            </div>
            <div class="col-md-12">
                @foreach($rounds as $r)
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>{{ $r->name }}
                                <small>| @if($r->status==0) En proceso @else Concluido @endif</small>
                            </h5>
                            @auth
                                {{--<div class="d-flex">
                                    @if($r->status == 0)
                                        <button class="btn btn-sm btn-outline-info btnUpdate mr-2"
                                                data-target="#round_{{$r->id}}"><i class="fa fa-sync">&nbsp;</i>Actualizar</button>
                                    @endif

                                    <form action="{{ route('round.update', ['id'=> $r->id]) }}" method="post">
                                        {{ csrf_field() }}
                                        --}}{{--Status>>-2 Pospuesto | -1: Por jugarse | 0: En proceso | 1: Finalizado | 2: Finalizado en penales--}}{{--
                                        @if($r->status == 1)
                                            <button class="btn btn-sm btn-outline-danger"
                                                    value="in_game"
                                                    name="opc"><i class="fa fa-long-arrow-alt-left">&nbsp;</i>Está en proceso</button>
                                        @else
                                            <button class="btn btn-sm btn-outline-dark"
                                                    value="end_game"
                                                    name="opc"><i class="fa fa-hourglass-end ">&nbsp;</i>Ha concluido</button>
                                        @endif
                                    </form>

                                </div>--}}
                            @endauth
                        </div>
                        <div class="card-body @if($r->status == 1) bw @endif">


                            @foreach($time_tables as $tt)
                                @if($tt->round_id == $r->id)
                                    @if($tt->team_a != null and $tt->team_b !=null)
                                        <div class="row league-match">
                                            <div class="col-md-5">
                                                <img src="{{ asset($tt->logo_a) }}" width="35px" class="rounded-circle">
                                                {{ $tt->team_a }}
                                            </div>
                                            <div class="col-md-2 text-center">
                                                @switch($tt->status)
                                                    @case(-2)
                                                    <span class="badge badge-dark">Pospuesto</span>
                                                    @break
                                                    @case(-1)
                                                    <span class="badge badge-primary">Por jugarse</span>
                                                    @break
                                                    @case(0)
                                                    <span class="badge badge-success">En proceso</span>
                                                    @break
                                                    @case(1)
                                                    <span class="badge badge-danger">Finalizado</span>
                                                    @break
                                                    @case(2)
                                                    <span class="badge badge-secondary">Finalizado en penales</span>
                                                    @break
                                                @endswitch
                                                    <br><small class="text-center" style="font-size: .7em">{{ $tt->date }} | {{ $tt->hour }}</small>
                                            </div>
                                            <div class="col-md-5 team_b">
                                                {{ $tt->team_b }}
                                                <img src="{{ asset($tt->logo_b) }}" width="35px" class="rounded-circle">
                                            </div>
                                            {{--@if($tt->status!=-2)
                                                <td width="35%">
                                                    <div class="d-flex vs">
                                                        <input type="hidden"
                                                               data-id="time_table_id"
                                                               value="{{ $tt->id }}">
                                                        <input type="date"
                                                               value="{{ $tt->date }}"
                                                               data-id="date"
                                                               class="form-control" placeholder="Fecha">
                                                        <input type="time"
                                                               value="{{ $tt->hour }}"
                                                               data-id="hour" class="form-control" placeholder="Hora">
                                                    </div>

                                                </td>
                                                <td>
                                                    <a href="{{ route('result.edit', ['id'=> $tt->id]) }}"
                                                       data-placement="top" title="Jugar"
                                                       class="btn btn-sm btn-light btn-tooltip"><i class="fa fa-play"></i></a>
                                                    <button data-timetable="{{ $tt->id }}"
                                                            data-round="{{ $r->id }}"
                                                            data-placement="top" title="Postergar"
                                                            class="btn btn-sm btn-danger btn-tooltip postergar"><i class="fa fa-ban"></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td>
                                                    --}}{{--Formulario para posponer partidos--}}{{--
                                                    <form method="post"
                                                          action="{{ route('postponed.destroy', ['time_table_id'=>$tt->id]) }}"
                                                          id="postponed_{{$tt->id}}"
                                                          class="form-confirm">
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                                data-placement="right" title="Cancelar partido Pospuesto"
                                                                class="btn btn-sm btn-warning btn-tooltip"><i class="fa fa-backspace"> </i> Cancelar</button>
                                                    </form>
                                                </td>
                                            @endif--}}
                                        </div>
                                    @else
                                        <div class="row">
                                            @if($tt->team_a != null)
                                                <div class="col-md-12 mt-2">
                                                    <img class="bw rounded-circle" src="{{ asset($tt->logo_a) }}" width="35px">
                                                    {{ $tt->team_a }} <small>| Descansa</small>
                                                </div>
                                            @else
                                                <div class="col-md-12 mt-2">
                                                    <img class="bw rounded-circle" src="{{ asset($tt->logo_b) }}" width="35px">
                                                    {{ $tt->team_b }} <small>| Descansa</small>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            @endforeach

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @if(count($time_groups)==0 && count($league)==0)
            <div class="group-body">
                <div class="alert info">
                    <div>
                        <i class="fa fa-futbol" aria-hidden="true"></i>
                        Estamos preparando las fechas para este torneo, regresa mas tarde
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection
@section('style')

@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
        $(function(){


            $('.accordion .ask').on('click', function(){
                $('.accordion').find('.answer').each(function () {
                    $(this).removeClass('active');
                });
                var answer = $(this).next();
                $('.accordion .answer').not(answer).slideUp(400);
                //	answer.slideToggle(400);//можно закрывать все
                answer.slideDown(400);//один всегда открыт
            });
        });
    </script>
@endsection