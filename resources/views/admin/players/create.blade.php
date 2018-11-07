@extends('layouts.app')

@section('content')
    <div class="container" id="player">
        @include('layouts.notify')
        <div class="row">
            <div class="col-md-6">
                <h3>Nuevo jugador</h3>
                <hr>
                <form action="{{route('player.store')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="team_id" value="{{$team_id}}">
                    <input type="hidden" name="type_team" value="{{$team->type}}">
                    {{--Campos basicos--}}
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Nombre</label>
                            <input type="text"
                                   name="name"
                                   required
                                   value="{{ old('name') }}"
                                   maxlength="100"
                                   class="form-control" placeholder="Ingrese nombre">
                        </div>
                        <div class="col-md-6">
                            <label>Apellido</label>
                            <input type="text"
                                   name="last_name"
                                   required
                                   value="{{ old('last_name') }}"
                                   maxlength="100"
                                   placeholder="Ingrese Apellido"
                                   class="form-control">
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Dni</label>
                            <input type="text"
                                   name="dni"
                                   maxlength="20"
                                   value="{{ old('dni', 0000000000) }}"
                                   placeholder="Ingrese Dni"
                                   class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Edad</label>
                            <input type="number"
                                   name="age"
                                   value="{{old('age', 18)}}"
                                   placeholder="Ingrese edad"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Genero</label>
                            <select name="type" class="form-control">
                                <option value="Male">Masculino</option>
                                <option value="Female">Femenino</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Número de Camiseta</label>
                            <input type="number"
                                   required
                                   name="number"
                                   class="form-control"
                                   placeholder="Ingrese el numero de camiseta" value="{{ old('number', 0) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea name="observation" cols="30" rows="5" class="form-control">

                        </textarea>
                        <br>
                        <input type="submit" value="Guardar" class="btn btn-success">
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <h3>Jugador existente</h3><hr>
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
                <br><br>
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