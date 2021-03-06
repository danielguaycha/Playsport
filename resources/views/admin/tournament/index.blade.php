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
        <br>
        <table class="table table-responsive-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>F. Inicio</th>
                <th>F. Fin</th>
                <th>Género</th>
                <th>Estado</th>
                <th>Deporte</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach($tournaments as $t)
                    <tr>
                        <td scope="row">{{ $t->id }}</td>
                        <td>{{$t->name}}</td>
                        <td>{{$t->date_init}}</td>
                        <td>{{$t->date_end}}</td>
                        <td>{{$t->type}}</td>
                        @if($t->status == 0)
                            <td class="font-weight-bold border-success text-success">Activo</td>
                        @else
                            <td class="border-danger text-danger">Terminado</td>
                        @endif

                        <td>{{$t->sport}}</td>
                        <td>
                            <a href="{{route("tournament.edit", ['id'=> $t->id])}}" class="btn btn-sm btn-info">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form id="delete_tournament" action="{{ route('tournament.destroy', ['id'=> $t->id ]) }}" method="post" class="form-confirm d-inline-block">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i> </button>
                            </form>
                            <a href="{{ route('tournament.show', ['id'=> $t->id ]) }}" class="btn btn-success btn-sm"><i class="fa fa-cogs "></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection