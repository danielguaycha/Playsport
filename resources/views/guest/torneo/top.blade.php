@extends('layouts.guest')

@section('content')
    <main class="content-max">
        @include('guest.torneo.partials._futbol', $tournament)
        <div class="group-body">
            @if(count($goals)>0)
            <table class="table table-hover">
                <tbody>
                <tr class="table-row-title">
                    <th colspan="2" class="text-left">Jugador</th>
                    <th>{{ $tournament->denomination }}</th>
                </tr>
                @php
                    $i = 1;
                @endphp
                @foreach($goals as $g)
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
            @else
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