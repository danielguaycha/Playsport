@extends('layouts.guest')

@section('content')
    <main class="content-max">

        @include('guest.torneo.partials._futbol', [$tournament, $pages])

        @foreach( $groups as $g)
            <div class="group-content">
                <div class="group-title">{{ $g->name }}</div>
                <table class="table table-hover">
                    <tbody>
                    <tr class="table-row-title">
                        <th colspan="2" class="text-left">Equipo</th>
                        <th>PJ</th>
                        <th>GF</th>
                        <th>GC</th>
                        <th>PG</th>
                        <th>PP</th>
                        <th>PE</th>
                        <th>Pts</th>
                    </tr>
                    @php
                        $i = 1;
                    @endphp
                    @foreach( $teams as $t )
                        @if($t->group_id == $g->id)
                            <tr>
                                <td width="1%">{{ $i }}</td>
                                <td class="table-img-logo">
                                    @if(count(explode('.', $t->logo))==2)
                                        @if($t->type == 'Male')
                                            <img src="{{ Avatar::create($t->alias)->toBase64() }}" width="30px"/>
                                        @else
                                            <img src="{{ Avatar::create($t->alias)->setBorder(1, "#C2185B")->toBase64() }}" width="30px"/>
                                        @endif
                                    @else
                                        @if($t->type == 'Male')
                                            <img src="{{ Avatar::create($t->alias)->setBackground($t->logo)->toBase64() }}" width="30px"/>
                                        @else
                                            <img src="{{ Avatar::create($t->alias)
                                                ->setBorder(5, "#C2185B")
                                                ->setBackground($t->logo)->toBase64() }}" width="30px"/>
                                        @endif
                                    @endif
                                    <span class="movil-hide">{{ $t->name }}</span>
                                </td>
                                <td class="text-center" width="4%">{{$t->pj}}</td>
                                <td class="text-center" width="4%">{{ $t->gf }}</td>
                                <td class="text-center" width="4%">{{ $t->gc }}</td>
                                <td class="text-center" width="4%">{{ $t->pg }}</td>
                                <td class="text-center" width="4%">{{ $t->pp }}</td>
                                <td class="text-center" width="4%">{{ $t->pe }}</td>
                                <td class="text-center" width="4%">{{ $t->pts }}</td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    </main>
@endsection