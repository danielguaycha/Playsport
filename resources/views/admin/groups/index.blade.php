@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="sp-title">
            <h3>Grupos</h3>
            <form class="form-inline">
                <div class="form-group">
                    <select class="form-control" name="tournament" id="tournament">
                        <option value="1">Torneo 1</option>
                        <option value="1">Torneo 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-info">Filtrar Torneo</button>
                </div>
            </form>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 p-3">
                <h6 class="d-inline-block">Grupo Nombre A</h6>
                <div class="d-inline-block float-right">
                    <a href="#" class="btn text-danger"><i class="fa fa-trash"></i></a>
                    <a href="#" class="btn text-info"><i class="fa fa-pencil-alt"></i></a>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Equipo</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td scope="row">Name</td>
                        <td>Opt</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection