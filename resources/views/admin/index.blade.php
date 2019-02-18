@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <div class="sp-title">
            <h3>Torneos</h3>
            <div>
                <a href="{{ route('tournament.create') }}" class="btn btn-dark"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="row">
            @if(count($tournaments)>0)
                @foreach($tournaments as $t)
                    <div class="col-sm-6 col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset($t->logo) }}"
                                         @if($t->status == 1) style="filter: grayscale(100%);" @endif
                                         class="img-thumbnail rounded-circle" width="60px">
                                </div>
                                <div class="col-md-6 text-right d-flex justify-content-end align-items-center">
                                    <a href="{{route("team.create", ['tournament'=> $t->id, 'sport'=> $t->sport])}}" class="btn btn-primary btn-sm"><i class="fa fa-users"> &nbsp;</i>{{ $t->teams }} + </a>
                                    <div class="dropdown ml-2">
                                        {{--Teams--}}
                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-cogs"></i>
                                        </button>

                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                            {{--Options--}}
                                            <form action="{{ route('tournament.process', ['id'=> $t->id ]) }}" method="post">
                                                {{ csrf_field() }}
                                                <button type="submit" class="dropdown-item" name="opc" value="end">Marcar como concluido</button>
                                                <button type="submit" class="dropdown-item" name="opc" value="active">Marcar como en proceso</button>
                                            </form>

                                            {{--Modificar--}}
                                            <a href="{{ route('tournament.edit', ['id'=> $t->id ]) }}" class="dropdown-item">Modificar</a>

                                            {{--Elimiar--}}
                                            <form id="delete_tournament" action="{{ route('tournament.destroy', ['id'=> $t->id ]) }}" method="post" class="form-confirm">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button class="dropdown-item" >Eliminar </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title">{{ $t->name }}</h5>
                            {{--Estados--}}
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="#" class="badge badge-dark">{{ $t->sport  }}</a>
                                    <a href="#" class="badge badge-secondary">Prioridad: {{ $t->priority  }}</a>
                                    @switch($t->status)
                                        @case(0)
                                        <span class="badge badge-success">Activo</span>
                                        @break
                                        @case(1)
                                        <span class="badge badge-danger">Finalizado</span>
                                        @break
                                    @endswitch
                                </div>
                            </div>

                            <p class="card-text">{{ $t->rules }}</p>
                            <a href="{{ route('tournament.show', ['id'=> $t->id]) }}" class="btn btn-primary">Gestionar</a>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-md-12 mt-4">
                    <div class="alert alert-info" role="alert">
                        <b>Aviso:</b> Aún no has agregado ningún torneo, hazlo desde el botón "<b>+</b>"
                    </div>
                </div>

            @endif

        </div>

        <nav>
            {{ $tournaments->links() }}
        </nav>
    </div>
@endsection