@extends('layouts.app')

@section('content')
    <div class="container" id="player">
        @include('layouts.notify')
        <div class="row">
            <div class="col-md-6">
                @include('admin.players.partials._new', [$team, $team_id])
            </div>
            <div class="col-md-6">
            {{--    <h3>Jugador existente</h3><hr>
                <form class="form-inline d-flex justify-content-center">
                    <div class="form-group">
                        <input type="search"
                               name="" id="" class="form-control" placeholder="Buscar por nombre">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Buscar">
                    </div>
                </form>
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td scope="row"></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
                <br><br>--}}
                <h3>Lista de Jugadores</h3>
                <hr>
                <table class="table table-borderless">
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
                            <td>{{$p->id}}</td>
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
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script>

        const vue = new Vue({
            el: '#player',
            data() {
                return {

                }
            },
            methods: {
                deletePlayer(id){
                    let c = confirm("Deseas eliminar este jugador?");
                    if (c){
                        document.getElementById(id).submit();
                    }
                }
            }
        });
    </script>
@endsection