@extends('layouts.guest')

@section('content')
    <main class="content-max">

        @include('guest.torneo.partials._futbol', [$tournament, $pages])
        @if(count($groups)>0)
        @foreach( $groups as $g)
            <div class="group-content" @if($g->class=='group') style="margin-top: 1rem;" @endif>
                <div class="group-title">
                    @if($g->class=='group')
                        <b>{{ $g->name }}</b>
                    @else
                        <b>{{ $g->name }}</b>
                    @endif
                </div>
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
            @else
            <div class="group-body">
                <div class="alert info">
                    <div>
                        <i class="fa fa-futbol" aria-hidden="true"></i>
                        Estamos preparando los grupos y ligas para este torneo, regresa mas tarde
                    </div>
                </div>
            </div>
            @endif
    </main>
@endsection