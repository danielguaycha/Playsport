@extends('layouts.guest')

@section('content')

    <main class="content-max">
        @include('guest.torneo.partials._futbol', $tournament)

        @if(count($time_groups)>0)
            <div class="group-content">
                <div class="group-title">
                    @if($groups > 1)
                        Fase de Grupos
                    @else
                        {{ ($time_groups[0]->group) }}
                    @endif
                </div>
                <table class="table table-hover">
                    <tbody>
                    <tr class="table-row-title">
                        <th class="movil-hide">#</th>
                        <th class="text-left"  @if($groups == 1) style="display: none;" @endif>Grupo</th>
                        <th>Equipo A</th>
                        <th class="text-center movil-hide">/</th>
                        <th>Equipo B</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                    </tr>
                    @php
                        $i = 1;
                        $tmpDate = null;
                    @endphp
                    @foreach($time_groups as $g)
                            <tr>

                            <td width="1%" class="movil-hide">{{ $i }}</td>
                            <td width="10%" @if($groups == 1) style="display: none;" @endif>{{$g->group}}</td>
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
                                @if($g->type_a == 'Male')
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
                            <td class="text-center" width="5%">{{ substr($g->hour, 0, 5) }}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>
@endsection