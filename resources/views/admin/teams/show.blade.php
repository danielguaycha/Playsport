@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="sp-title">
            <h3>Equipo: <span>{{ $team->name }}</span></h3>

        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Genero</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($players as $p)
                        <tr>
                        <td>1</td>
                        <td scope="row">{{$p->name}} {{$p->last_name}}</td>
                        <td>{{$p->type}}</td>
                        <td class="d-flex align-content-around">
                            <form method="post" action="{{route('player.destroy', ['player'=> $p->id])}}" id="p_{{$p->id}}">
                                {{ csrf_field() }}
                                {{ method_field("DELETE") }}
                                <button @click.prevent="deletePlayer('p_{{$p->id}}')" type="button" class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <a href="{{route("player.edit", ['id'=> $p->id])}}" class="btn btn-outline-info btn-sm"><i class="fa fa-pen"></i></a>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection