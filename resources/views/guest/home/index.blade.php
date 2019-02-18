@extends('layouts.guest')

@section('content')
<main class="container">
    <div class="row">

        <div class="col-md-8">
            <div class="sa-container">
                <div class="sa-head" style="background-image: url('{{ asset('img/home-banner.jpg') }}') ">
                    <a href="{{ url('/'.$tournament->url.'/fechas') }}">
                        <img class="img-thumbnail"
                             src="{{ asset($tournament->logo) }}" width="60px">
                        <h4>
                            {{ $tournament->name }}
                        </h4>
                        <p>
                            {{ $tournament->rules  }}
                        </p>
                    </a>
                </div>

                <div>
                    <article class="sa-tabs">
                        <div class="tab">
                            @if(count($liga)>0)
                                <button class="tablinks active" data-id="t1">Liga</button>
                            @endif
                            @if(count($groups)>1)
                                <button class="tablinks" data-id="t2">F. de Grupos</button>
                            @endif
                            @if(count($stages)>0)
                                <button class="tablinks" data-id="t3">Eliminatoria</button>
                            @endif
                            @if(count($stats)>0)
                                <button class="tablinks" data-id="t4">Estadistica</button>
                            @endif
                        </div>

                        {{--Liga--}}
                        @if(count($liga)>0)
                            <div class="tabcontent active" id="t1">
                                <div class="torneo liguilla">
                                           <div class="torneo-titulo">
                                               <span><i class="fa fa-receipt">&nbsp;</i> Liguilla</span>
                                           </div>
                                           <div class="torneo-body">
                                               <div class="group-content">
                                                   <div class="group-title">{{ $liga->name }}</div>
                                                   <div class="table-responsive">
                                                       <table class="table table-hover">
                                                           <tbody>
                                                           <tr class="table-row-title">
                                                               <th colspan="2" class="text-left">Equipo</th>
                                                               <th>PJ</th>
                                                               <th>PG</th>
                                                               <th>PP</th>
                                                               <th>PE</th>
                                                               <th>{{ substr($tournament->denomination, 0 ,1) }}F</th>
                                                               <th>{{ substr($tournament->denomination, 0 ,1) }}C</th>
                                                               <th>{{ substr($tournament->denomination, 0 ,1) }}D</th>
                                                               @if($tournament->sports_id == 1 || $tournament->sports_id == 4 || $tournament->sports_id == 3)
                                                                   <th>PTS</th>
                                                               @endif
                                                           </tr>
                                                           @php
                                                               $i = 1;
                                                           @endphp
                                                           @foreach( $liga_equipos as $t )
                                                               @if($t->group_id == $liga->id)
                                                                   <tr>
                                                                       <td width="1%">{{ $i }}</td>
                                                                       <td class="table-img-logo">
                                                                           <img src="{{ asset($t->logo) }}" width="30px"/>
                                                                           <span class="movil-hide">{{ $t->name }}</span>
                                                                       </td>

                                                                       <td class="text-center" width="4%">{{$t->pj}}</td>
                                                                       <td class="text-center" width="4%">{{ $t->pg }}</td>
                                                                       <td class="text-center" width="4%">{{ $t->pp }}</td>
                                                                       <td class="text-center" width="4%">{{ $t->pe }}</td>

                                                                       <td class="text-center" width="4%">{{ $t->gf }}</td>
                                                                       <td class="text-center" width="4%">{{ $t->gc }}</td>
                                                                       <td class="text-center" width="4%">{{ $t->gd }}</td>

                                                                       @if($tournament->sports_id == 1 ||
                                                                           $tournament->sports_id == 4 || $tournament->sports_id == 3)
                                                                           <td class="text-center" width="4%">{{ $t->pts }}</td>
                                                                       @endif
                                                                   </tr>
                                                                   @php
                                                                       $i++;
                                                                   @endphp
                                                               @endif
                                                           @endforeach
                                                           </tbody>
                                                       </table>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                <div class="fechas liguilla">
                                    <div class="torneo-titulo">
                                        <span><i class="fa fa-calendar">&nbsp;</i> Fechas</span>
                                    </div>
                                    @if(count($liga_rondas)>0)
                                    <div class="owl-carousel owl-theme">
                                        @foreach($liga_rondas as $r)
                                            <div class="item round-item" id="round_{{ $r->id }}">
                                                <div class="sa-date-title">
                                                    <h4>{{ $r->name }}</h4>
                                                    <button class="btn btnSave" data-id="round_{{ $r->id }}">
                                                        <i class="fa fa-download"></i>
                                                    </button>
                                                </div>
                                                @foreach($liga_fechas as $tt)
                                                    @if($tt->round_id == $r->id)
                                                        <div class="sa-date" >
                                                            <div class="sa-date-head">
                                                                <span>{{ $tt->team_a }} vs {{ $tt->team_b }}</span>
                                                                @if($tt->date)
                                                                    <div class="date">
                                                                        <span>
                                                                        @switch($tt->status)
                                                                            @case(-2)
                                                                                Pospuesto
                                                                            @break;
                                                                            @case(-1)
                                                                                {{ $tt->date }} | {{ $tt->hour }}
                                                                            @break;
                                                                            @case(0)
                                                                                En proceso
                                                                            @break;
                                                                            @case(1)
                                                                                Finalizado
                                                                            @break;
                                                                        @endswitch
                                                                        </span>

                                                                        @auth
                                                                            <div class="buttons">
                                                                                <button type="submit"
                                                                                        onclick="window.location='{{ route("result.edit", ["id"=> $tt->id ]) }}';">
                                                                                    <i class="fa fa-play"></i>
                                                                                </button>
                                                                                <button type="submit"
                                                                                        onclick="window.location='{{ route("timetable.edit", ["id"=> $tt->id, "group_id"=> $tt->group_id ]) }}';">
                                                                                    <i class="fa fa-clock"></i>
                                                                                </button>
                                                                            </div>
                                                                        @endauth
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="sa-date-match">
                                                                <div class="team">
                                                                    <img src="{{ asset($tt->logo_a) }}" alt="">
                                                                    <span>{{ $tt->team_a }}</span>
                                                                </div>
                                                                <div class="result">
                                                                    <div>
                                                                        <span>{{ $tt->result_a }}</span> -
                                                                        <span>{{ $tt->result_b }}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="team">
                                                                    <span>{{ $tt->team_b }}</span>
                                                                    <img src="{{ asset($tt->logo_b) }}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endforeach
                                        {{--<div class="item">
                                            <div class="sa-date-title">
                                                <h4>Rounda 1</h4>
                                            </div>
                                            <div class="sa-date">
                                                <div class="sa-date-head">
                                                    <span>Team ABCD vs Team CDE</span>
                                                    <span>10/10/2019</span>
                                                </div>
                                                <div class="sa-date-match">
                                                    <div class="team">
                                                        <img src="{{ asset('img/teams/1548036830.png') }}" alt="">
                                                        <span>Equipo 1 ABC</span>
                                                    </div>
                                                    <div class="result">
                                                        <div>
                                                            <span>1</span> -
                                                            <span>2</span>
                                                        </div>

                                                    </div>
                                                    <div class="team">
                                                        <img src="{{ asset('img/teams/1548037295.png') }}" alt="">
                                                        <span>Equipo 2 DEF</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="sa-date">
                                                <div class="sa-date-head">
                                                    <span>Team ABCD vs Team CDE</span>
                                                    <span>10/10/2019</span>
                                                </div>
                                                <div class="sa-date-match">
                                                    <div class="team">
                                                        <img src="{{ asset('img/teams/1548036830.png') }}" alt="">
                                                        <span>Equipo 1 ABC</span>
                                                    </div>
                                                    <div class="result">
                                                        <div>
                                                            <span>1</span> -
                                                            <span>2</span>
                                                        </div>

                                                    </div>
                                                    <div class="team">
                                                        <img src="{{ asset('img/teams/1548037295.png') }}" alt="">
                                                        <span>Equipo 2 DEF</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>--}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{--Fase de grupos--}}
                        @if(count($groups)>1)
                            <div class="tabcontent" id="t2">
                                <div class="torneo fase-grupos">
                                        <div class="torneo-titulo">
                                            <span> <i class="fa fa-th-large">&nbsp;</i> Fase de Grupos</span>
                                        </div>
                                        <div class="torneo-body">
                                            @foreach( $groups as $g)
                                                <div class="group-content">
                                                    <div class="group-title">{{ $g->name }}</div>
                                                    <div class="table-responsive">
                                                        <table class="table table-hover">
                                                            <tbody>
                                                            <tr class="table-row-title">
                                                                <th colspan="2" class="text-left">Equipo</th>
                                                                <th>PJ</th>
                                                                <th>PG</th>
                                                                <th>PP</th>
                                                                <th>PE</th>
                                                                <th>{{ substr($tournament->denomination, 0 ,1) }}F</th>
                                                                <th>{{ substr($tournament->denomination, 0 ,1) }}C</th>
                                                                <th>{{ substr($tournament->denomination, 0 ,1) }}D</th>
                                                                @if($tournament->sports_id == 1 || $tournament->sports_id == 4 || $tournament->sports_id == 3)
                                                                    <th>PTS</th>
                                                                @endif
                                                            </tr>
                                                            @php
                                                                $i = 1;
                                                            @endphp
                                                            @foreach( $teams as $t )
                                                                @if($t->group_id == $g->id)
                                                                    <tr>
                                                                        <td width="1%">{{ $i }}</td>
                                                                        <td class="table-img-logo">
                                                                            <img src="{{ asset($t->logo) }}" width="30px"/>
                                                                            <span class="movil-hide">{{ $t->name }}</span>
                                                                        </td>

                                                                        <td class="text-center" width="4%">{{$t->pj}}</td>
                                                                        <td class="text-center" width="4%">{{ $t->pg }}</td>
                                                                        <td class="text-center" width="4%">{{ $t->pp }}</td>
                                                                        <td class="text-center" width="4%">{{ $t->pe }}</td>

                                                                        <td class="text-center" width="4%">{{ $t->gf }}</td>
                                                                        <td class="text-center" width="4%">{{ $t->gc }}</td>
                                                                        <td class="text-center" width="4%">{{ $t->gd }}</td>

                                                                        @if($tournament->sports_id == 1 ||
                                                                            $tournament->sports_id == 4 || $tournament->sports_id == 3)
                                                                            <td class="text-center" width="4%">{{ $t->pts }}</td>
                                                                        @endif
                                                                    </tr>
                                                                    @php
                                                                        $i++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                <div>
                                    <div class="torneo-titulo">
                                        <span><i class="fa fa-calendar">&nbsp;</i> Fechas</span>
                                    </div>

                                    <div class="owl-carousel owl-theme">
                                        @foreach($groups as $g)
                                            <div class="item" id="group_{{$g->id}}">
                                                <div class="sa-date-title">
                                                    <h4>{{ $g->name }}</h4>
                                                    <button class="btn btnSave" data-id="group_{{ $g->id }}">
                                                        <i class="fa fa-download"></i>
                                                    </button>
                                                </div>
                                                <div class="matches-content">
                                                    @foreach($groups_dates as $i=>$tg)

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

                                    </div>
                                </div>
                            </div>

                        @endif

                        {{--Eliminatoria--}}
                        @if(count($stages)>0)
                            <div class="tabcontent" id="t3">
                                <div class="torneo eliminatoria">
                                        <div class="torneo-titulo">
                                            <span><i class="fa fa-sitemap">&nbsp;</i> Eliminatoria</span>
                                        </div>
                                        <div class="torneo-body">
                                            @if(count($stages)==3)
                                                <div class="stage-title-2">
                                                    <span>{{ $stages[0]->stage }}</span>
                                                    <span>{{ $stages[2]->stage }}</span>
                                                </div>
                                                <div class="stage-match-2">
                                                    <div class="stage stage-2">
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach($stages as $s)
                                                            <div class="team_{{$i}} group-team">
                                                                <a @auth href="{{ route("stage.result", ['stage'=> $s->stage_id]) }}" @endauth class="">
                                                                    {{--Teams--}}
                                                                    <div class="teams">
                                                                        {{-- Team A --}}
                                                                        <div
                                                                                @if($s->result_a !=null)
                                                                                    @if($s->result_a>$s->result_b)
                                                                                        class="winner"
                                                                                    @elseif($s->result_a==$s->result_b)
                                                                                        @if($s->status == 2 && $s->penal_a > $s->penal_b)
                                                                                            class="winner"
                                                                                        @elseif($s->status == 1 || $s->status == 0)
                                                                                            class="par"
                                                                                        @else
                                                                                            class="lose"
                                                                                        @endif
                                                                                    @else
                                                                                        class="lose"
                                                                                    @endif
                                                                                @endif>

                                                                            <img src="{{ asset($s->logo_a) }}" width="30px"/>
                                                                            <span>{{ $s->team_a }}</span>
                                                                            <div>{{ $s->result_a==null?'0':$s->result_a }}</div>
                                                                        </div>
                                                                        {{-- Team B--}}
                                                                        <div
                                                                                @if($s->result_a !=null)
                                                                                @if($s->result_a<$s->result_b)
                                                                                class="winner"
                                                                                @elseif($s->result_a==$s->result_b)
                                                                                @if($s->status == 2 && $s->penal_a < $s->penal_b)
                                                                                class="winner"
                                                                                @elseif($s->status == 1 || $s->status == 0)
                                                                                class="par"
                                                                                @else
                                                                                class="lose"
                                                                                @endif
                                                                                @else
                                                                                class="lose"
                                                                                @endif
                                                                                @endif
                                                                        >

                                                                            <img src="{{ asset($s->logo_b) }}" width="30px"/>
                                                                            <span>{{ $s->team_b }}</span>
                                                                            <div>{{ $s->result_b==null?'0':$s->result_b }}</div>
                                                                        </div>
                                                                    </div>
                                                                    {{--Înfo--}}
                                                                    <div class="date">
                                                                        @if($s->status == -1)
                                                                            <span>{{ $s->date }}</span>
                                                                            <span>{{ $s->hour }}</span>
                                                                        @elseif($s->status == 0)
                                                                            <span class="status">En proceso</span>
                                                                        @elseif($s->status == 1 && $s->penal_a == null)
                                                                            <span class="status">Finalizado</span>
                                                                        @elseif($s->status == 1 && $s->penal_a!=null)
                                                                            <span>Finalizado en penales</span>
                                                                            <span>{{$s->penal_a}}:{{$s->penal_b}}</span>
                                                                        @endif
                                                                    </div>
                                                                </a>
                                                                @auth
                                                                    <div class="buttons">
                                                                        <button type="submit"
                                                                                onclick="window.location='{{ route("result.edit", ["id"=> $s->id ]) }}';">
                                                                            <i class="fa fa-play"></i>
                                                                        </button>
                                                                        <button type="submit"
                                                                                onclick="window.location='{{ route("timetable.edit", ["id"=> $s->id, "stage_id"=> $s->stage_id ]) }}';">
                                                                            <i class="fa fa-clock"></i>
                                                                        </button>
                                                                    </div>
                                                                @endauth
                                                            </div>
                                                            @php
                                                                $i++;
                                                            @endphp
                                                        @endforeach
                                                        <div class="result">
                                                            <a href="#">
                                                                <img src="{{asset('img/home/coup.png')}}" alt="team_a">
                                                                <span></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="line">
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>

                                            @elseif(count($stages)==1)
                                                <div class="stage-title-1 text-center">
                                                    {{ $stages[0]->stage }} <br><small><i class="fa fa-clock"> </i> {{ $stages[0]->date }} &nbsp; {{ $stages[0]->hour }}</small>
                                                </div>
                                                <div class="stage-match-1">
                                                    <div class="stage stage-1">
                                                        @foreach($stages as $i=> $s)
                                                            <div  class="matches team_1">
                                                                <a @auth href="{{ route("stage.result", ['stage'=> $s->stage_id]) }}" @endauth>
                                                                    <div
                                                                            @if($s->result_a !=null)
                                                                            @if($s->result_a>$s->result_b)
                                                                            class="team winner"
                                                                            @elseif($s->result_a==$s->result_b)
                                                                            @if($s->status == 2 && $s->penal_a > $s->penal_b)
                                                                            class="team winner"
                                                                            @elseif($s->status == 1 || $s->status == 0)
                                                                            class="team par"
                                                                            @else
                                                                            class="team lose"
                                                                            @endif
                                                                            @else
                                                                            class="team lose"
                                                                            @endif
                                                                            @else
                                                                            class="team"
                                                                            @endif
                                                                    >

                                                                        <img src="{{ asset($s->logo_a)  }}" width="30px"/>
                                                                        <span>{{$s->team_a}}</span>
                                                                        <div>{{ $s->result_a==null?'0': $s->result_a}}</div>
                                                                    </div>
                                                                    <div class="info">
                                                                        @if($s->status == -1)
                                                                            Por Jugarse
                                                                        @elseif($s->status == 0)
                                                                            <span class="status">En proceso</span>
                                                                        @elseif($s->status == 1)
                                                                            <span class="status">Finalizado</span>
                                                                        @elseif($s->status == 2)
                                                                            <span>Finalizado en penales</span>
                                                                            <span>{{$s->penal_a}}</span>
                                                                        @endif
                                                                    </div>
                                                                </a>
                                                                <div class="buttons">
                                                                    <button type="submit"
                                                                            onclick="window.location='{{ route("result.edit", ["id"=> $s->id ]) }}';">
                                                                        <i class="fa fa-play"></i>
                                                                    </button>
                                                                    <button type="submit"
                                                                            onclick="window.location='{{ route("timetable.edit", ["id"=> $s->id, "stage_id"=> $s->stage_id ]) }}';">
                                                                        <i class="fa fa-clock"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="matches team_2">
                                                                <a>
                                                                    <div
                                                                            @if($s->result_a !=null)
                                                                            @if($s->result_a<$s->result_b)
                                                                            class="team winner"
                                                                            @elseif($s->result_a==$s->result_b)
                                                                            @if($s->status == 2 && $s->penal_a < $s->penal_b)
                                                                            class="team winner"
                                                                            @elseif($s->status == 1 || $s->status == 0)
                                                                            class="team par"
                                                                            @else
                                                                            class="team lose"
                                                                            @endif
                                                                            @else
                                                                            class="team lose"
                                                                            @endif
                                                                            @else
                                                                            class="team"
                                                                            @endif
                                                                    >

                                                                        <img src="{{ asset($s->logo_b) }}" width="30px"/>
                                                                        <span>{{$s->team_b}}</span>
                                                                        <div>{{ $s->result_b==null?'0': $s->result_b }}</div>
                                                                    </div>
                                                                    <div class="info">
                                                                        @if($s->status == -1)
                                                                            <span>...</span>
                                                                        @elseif($s->status == 0)
                                                                            <span>...</span>
                                                                        @elseif($s->status == 1)
                                                                            <span>...</span>
                                                                        @elseif($s->status == 2)
                                                                            <span>Finalizado en penales</span>
                                                                            <span>{{$s->penal_b}}</span>
                                                                        @endif

                                                                    </div>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                        <div @auth href="{{ route("stage.result", ['stage'=> $s->stage_id]) }}" @endauth class="result">
                                                            <a href="#">
                                                                <img src="{{asset('img/home/coup.png')}}" alt="team_a">
                                                                <span></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="line">
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            @elseif(count($stages)==0)
                                                <div class="alert info">
                                                    <div>
                                                        <i class="fa fa-futbol" aria-hidden="true"></i>
                                                        Verás estos datos al iniciar el torneo!
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                            </div>
                        @endif

                        {{--Stats--}}
                        @if(count($stats)>0)
                        <div class="tabcontent" id="t4">

                            <table class="table table-hover">
                                <tbody>
                                <tr class="table-row-title">
                                    <th colspan="2" class="text-left">Jugador</th>
                                    <th>{{ $tournament->denomination }}</th>
                                </tr>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach($stats as $g)
                                    <tr>
                                        <td width="4%">{{ $i }}</td>
                                        <td class="table-img-top">
                                            <div class="top-player">
                                                {{ $g->name }} {{ $g->last_name }}
                                            </div>
                                            <div class="top-team">
                                                @if(count(explode('.', $g->logo))==2)
                                                    @if($g->type == 'Male')
                                                        <img src="{{ Avatar::create($g->alias)->toBase64() }}" width="30px"/>
                                                    @else
                                                        <img src="{{ Avatar::create($g->alias)->setBorder(1, "#C2185B")->toBase64() }}" width="30px"/>
                                                    @endif
                                                @else
                                                    @if($g->type == 'Male')
                                                        <img src="{{ Avatar::create($g->alias)->setBackground($g->logo)->toBase64() }}" width="30px"/>
                                                    @else
                                                        <img src="{{ Avatar::create($g->alias)
                                                    ->setBorder(5, "#C2185B")
                                                    ->setBackground($g->logo)->toBase64() }}" width="30px"/>
                                                    @endif
                                                @endif
                                                <span>
                                    {{ $g->team }}
                                </span>
                                            </div>
                                        </td>

                                        <td width="5%"> <b> {{ $g->goals }}</b></td>
                                    </tr>
                                    @php
                                        $i ++;
                                    @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </article>
                </div>


            </div>

        </div>

        <div class="col-md-4 other-torneos">
            @foreach($others as $o)
                <a href="{{ route('index', ['t'=> $o->id]) }}" class="mini-torneo">
                    <figure>
                        <img src="{{ asset($o->logo) }}">
                    </figure>
                    <div>
                        <div class="mini-torneo-content">
                            <div class="mini-torneo-head">
                                {{ $o->name }}
                            </div>
                            <div class="mini-torneo-body">

                            </div>
                            <div class="mini-torneo-footer">
                                @if($o->type=='Male')
                                    <i class="fa fa-mars"></i>
                                @else
                                    <i class="fa fa-venus"></i>
                                @endif
                                 | {{ $o->sport }}
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </div>
</main>
@endsection
@section('script')
    <script src="{{ asset('js/html2canvas.js') }}"></script>
    <script>
        $(function () {

            $(".btnSave").click(function() {
                $(this).hide();
                html2canvas($("#"+$(this).data('id')), {
                    onrendered: function(canvas) {
                        ///let getCanvas = canvas;

                       // document.querySelector('.canvas').appendChild(canvas);
                        download(canvas, "ShareImage.png")
                        $('.btnSave').show();
                    }
                });
            });
        });
        $(document).ready(function () {
            $('body').find('.tablinks').each(function (i) {
                if(i===0){
                    $(this).addClass('active');
                    $(this).parent().parent().find('.tabcontent').each(function (j) {
                        if(j===0){
                            $(this).addClass('active');
                        }
                    })
                }
            });
        })
        function download(canvas, filename) {
            /// create an "off-screen" anchor tag
            let lnk = document.createElement('a'), e;

            /// the key here is to set the download attribute of the a tag
            lnk.download = filename;

            /// convert canvas content to data-uri for link. When download
            /// attribute is set the content pointed to by link will be
            /// pushed as "download" in HTML5 capable browsers
            lnk.href = canvas.toDataURL("image/png;base64");

            /// create a "fake" click-event to trigger the download
            if (document.createEvent) {
                e = document.createEvent("MouseEvents");
                e.initMouseEvent("click", true, true, window,
                    0, 0, 0, 0, 0, false, false, false,
                    false, 0, null);

                lnk.dispatchEvent(e);
            } else if (lnk.fireEvent) {
                lnk.fireEvent("onclick");
            }
        }

        $('.tablinks').click(function () {
            $('.tabcontent.active').removeClass('active');
            $('.tablinks.active').removeClass('active');

            let id = $(this).data('id');
            $(this).addClass('active');
            $('#'+id).addClass('active');
        })

        $('.owl-carousel').owlCarousel({
            loop: false,
            margin:10,
            nav: true,
            items:1,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    </script>
@endsection