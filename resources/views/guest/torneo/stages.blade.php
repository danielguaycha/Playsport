@extends('layouts.guest')

@section('content')
    <main class="content-max">
        @include('guest.torneo.partials._futbol', $tournament)

        <div class="group-content">

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
                                                @endif
                                        >

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
                                        @elseif($s->status == 1)
                                            <span class="status">Finalizado</span>
                                        @elseif($s->status == 2)
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
                                            Pendiente
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

    </main>
@endsection