@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    {{--Header Tournament Info--}}
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <img src="{{ asset($tournament->logo) }}" width="30px" class="mr-1"> {{ $tournament->name }}
                            </div>
                            <div>
                                <span class="ml-2">
                                    Tipo:
                                    <span class="badge badge-info">
                                        @if($tournament->type == 'Female')
                                            Femenino
                                        @else
                                            Masculino
                                        @endif
                                    </span>
                                </span>
                                <span class="ml-2">
                                    Estado:
                                    @switch($tournament->status)
                                        @case(0)
                                        <span class="badge badge-success">Activo</span>
                                        @break
                                        @case(1)
                                        <span class="badge badge-danger">Finalizado</span>
                                        @break
                                    @endswitch
                                </span>
                                <span class="ml-2">Deporte: <span class="badge badge-info">{{ $tournament->sport }}</span></span>
                            </div>
                        </div>

                        {{--<div class="d-flex align-items-center">
                            <a class="btn btn-sm btn-outline-info mr-3" href="#">Equipos</a>
                            <a class="btn btn-sm btn-outline-info" href="{{ route('timetable.league', ['id'=> $tournament->id]) }}">Fechas</a>
                        </div>--}}
                    </div>
                    {{-- Tournament Body --}}
                    <div class="card-body">
                        {{-- Operations Buttons --}}
                        <div class="d-flex justify-content-between">
                            <div>
                             {{--   <div class="dropdown d-inline-block">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-receipt">&nbsp;</i> Liguilla
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                           href="{{ route('timetable.dates.league', ['tournament'=> $tournament->id]) }}">Sola de Ida</a>
                                        <a class="dropdown-item" href="#"></a>
                                    </div>
                                </div>--}}

                                <a href="{{ route('group.create', ['tournament'=> $tournament->id]) }}"
                                   aria-disabled="true"
                                   class="btn btn-light @if(count($teams)==0) disabled @endif">
                                    <i class="fa fa-th-large">&nbsp;</i> Fase de Grupos
                                </a>
                                <a href="{{ route('timetable.dates.league', ['tournament'=> $tournament->id]) }}"
                                   class="btn btn-light @if(count($teams)==0) disabled @endif">
                                    <i class="fa fa-receipt">&nbsp;</i> Liguilla
                                </a>
                                <a href="{{ route('stage.create', ['tournament'=> $tournament->id]) }}"
                                   class="btn btn-light @if(count($teams)==0) disabled @endif">
                                    <i class="fa fa-sitemap">&nbsp;</i> Eliminatoria
                                </a>
                            </div>
                            <div>
                                <a href="{{route("team.create", ['tournament'=> $tournament->id, 'sport'=> $tournament->sport, 'type'=> $tournament->type])}}"
                                   class="btn btn-light open-window"><i class="fa fa-users">&nbsp;</i> Agregar Equipo</a>
                            </div>
                        </div>

                        <div class="row mt-4">
                            @foreach($ligues as $l)
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $l->name }}</h5>
                                            <h6 class="card-subtitle mb-2 text-muted">
                                                Liguilla
                                                @if($l->status==0)
                                                    <span class="badge badge-success">Activa</span>
                                                @else
                                                    <span class="badge badge-danger">Finalizada</span>
                                                @endif
                                            </h6>
                                            <div class="d-flex">
                                                <a href="{{ route('league.show', ['group_id'=> $l->id ]) }}"
                                                       class="btn btn-info btn-sm">Gestionar</a>
                                                <div class="dropdown ml-2">
                                                    {{--Teams--}}
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cogs"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                        {{--Options--}}
                                                        <form action="{{ route('group.process', ['id'=> $l->id]) }}" method="post">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="dropdown-item" name="opc" value="end">Marcar como concluido</button>
                                                            <button type="submit" class="dropdown-item" name="opc" value="active">Marcar como en proceso</button>
                                                        </form>

                                                        {{--Elimiar--}}
                                                        <form id="delete_tournament" action="{{ route('group.destroy', ['id'=>$l->id ]) }}" method="post" class="form-confirm">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button class="dropdown-item" >Eliminar <span class="text-danger">(Destructivo)&nbsp; <i class="fa fa-exclamation-triangle"></i></span></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            {{--Grupos--}}
                            @if(count($groups)>0)
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Fase de grupos</h5>
                                            <h6 class="card-subtitle mb-2 text-muted"><span class="badge badge-secondary">{{ count($groups) }} grupos</span></h6>
                                            <div class="d-flex">
                                                <a href="{{ route('dates.group.show', ['id'=> $tournament->id ]) }}" class="btn btn-info btn-sm">Gestionar</a>
                                                <div class="dropdown ml-2">
                                                    {{--Teams--}}
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-cogs"></i>
                                                    </button>

                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                        {{--Options--}}
                                                        {{--<form action="" method="post">
                                                            {{ csrf_field() }}
                                                            <button type="submit" class="dropdown-item" name="opc" value="end">Marcar como concluido</button>
                                                            <button type="submit" class="dropdown-item" name="opc" value="active">Marcar como en proceso</button>
                                                        </form>--}}

                                                        {{--Elimiar--}}
                                                        <a href="{{ route('group.create', ['tournament'=> $tournament->id]) }}" class="dropdown-item">Editar</a>
                                                        <form id="delete_group" action="{{ route('group.destroy_all', ['id'=> $tournament->id]) }}" method="post" class="form-confirm">
                                                            {{ csrf_field() }}
                                                            <button class="dropdown-item" >Eliminar <span class="text-danger">(Destructivo)&nbsp; <i class="fa fa-exclamation-triangle"></i></span></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{--Eliminatorias--}}
                            @if(count($stages)>0)
                                @foreach($stages as $st)
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $st->name }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">
                                                    Eliminatoria
                                                    @if($st->status==0)
                                                        <span class="badge badge-success">Activa</span>
                                                    @else
                                                        <span class="badge badge-danger">Finalizada</span>
                                                    @endif
                                                </h6>
                                                <div class="d-flex">
                                                    <a href="{{ route('stage.show', ['tournament_id'=> $tournament->id]) }}"
                                                       class="btn btn-info btn-sm">Gestionar</a>
                                                    <div class="dropdown ml-2">
                                                        {{--Teams--}}
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-cogs"></i>
                                                        </button>

                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                            {{--Options--}}
                                                          {{--  <form action="" method="post">
                                                                {{ csrf_field() }}
                                                                <button type="submit" class="dropdown-item" name="opc" value="end">Marcar como concluido</button>
                                                                <button type="submit" class="dropdown-item" name="opc" value="active">Marcar como en proceso</button>
                                                            </form>--}}

                                                            {{--Elimiar--}}
                                                           <form id="delete_stage" action="{{ route('stage.destroy_all', ['id'=> $tournament->id]) }}" method="post" class="form-confirm">
                                                                {{ csrf_field() }}
                                                                <button class="dropdown-item" >Eliminar <span class="text-danger">(Destructivo)&nbsp; <i class="fa fa-exclamation-triangle"></i></span></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        {{-- Teams List --}}
                        <div class="table-responsive mt-4">
                            @if(count($teams)>0)
                                <table class="table table-sm table-hover ">
                                    <thead>
                                    <tr>
                                        <th scope="col" width="30%">Nombre</th>
                                        <th>Jugadores</th>
                                        <th scope="col" width="15%">Opciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($teams as $team)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($team->logo)  }}" class="rounded-circle" width="30px">
                                                {{$team -> name}}
                                            </td>
                                            <td>{{ $team->number }}</td>
                                            <td>
                                                <form id="team_{{ $team->id }}" class="d-inline-block" action="{{route('team.destroy', ['id'=> $team->id])}}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="removeTeam('team_{{ $team->id }}')"><i class="fa fa-trash"></i></button>
                                                </form>
                                                <a href="{{route("team.edit", ["id"=> $team-> id])}}" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                                                <a href="{{ route("player.create", ['t'=> $team-> id] ) }}"
                                                   title="Nuevo Jugador"
                                                   class="btn btn-sm btn-dark open-window"><i class="fa fa-user-plus"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info mt-4" role="alert">
                                    <strong>Info!</strong> Agrega equipos para poder crear ligas, eliminatorias o fases de grupos!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        function removeTeam(id){
            if(confirm("Realmente deseas eliminar este equipo?"))
                document.getElementById(id).submit();
        }
    </script>
@endsection