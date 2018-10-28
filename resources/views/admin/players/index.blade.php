@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="sp-title">
            <h3>Jugadores</h3>
            <div>
                <a href="#" class="btn btn-outline-danger"><i class="fa fa-female"></i></a>
                <a href="#" class="btn btn-outline-info"><i class="fa fa-male"></i></a>
                <form class="form-inline">
                    <input type="search" placeholder="Nombre de Equipo" class="form-control">
                    <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <br>
        <table class="table table-sm table-hover table-responsive">
            <thead>
            <tr>
                <th scope="col" width="20%">Equipo</th>
                <th scope="col" width="10%">Dni</th>
                <th scope="col" width="30%">Nombre</th>
                <th scope="col" width="5%">Edad</th>
                <th scope="col" width="10%">Género</th>
                <th scope="col" width="25%">Observaciones</th>
                <th scope="col" width="10%">Opciones</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <img src="{{asset('img/logo.png')}}" width="20px">
                    8avo Semestre "A"</td>
                <td>0706271301</td>
                <td>Daniel Afranio Guaycha Apolinario</td>
                <td>20</td>
                <td>Masculino</td>
                <td>LoremIpsum</td>
                <td>
                    <a href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    <a href="{{route("player.edit", ["id"=> 1])}}" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection