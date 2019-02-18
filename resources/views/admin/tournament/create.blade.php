@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Crear Torneo</h3>
        <hr>
        <form action="{{route('tournament.store')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{--Nombre--}}
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text"
                           class="form-control"
                           name="name" required placeholder="Ingrese nombre de Torneo" maxlength="100">
                </div>
                <div class="col-md-6">
                    <label>Logo</label>
                    <input type="file"
                           class="form-control-file"
                           name="logo" placeholder="Seleccione Logo">
                </div>

            </div>
            {{--Fechas--}}
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Fecha de inicio</label>
                    <input type="date"
                           class="form-control"
                           required
                           name="date_init" placeholder="Fecha de inicio">
                </div>
                <div class="col-md-6">
                    <label>Fecha de fin</label>
                    <input type="date"
                           class="form-control"
                           required
                           name="date_end" placeholder="Fecha de Fin">
                </div>
            </div>
            {{--Genero y Deporte--}}
            <div class="form-group row">
                <div class="col-md-4">
                    <label>Modalidad</label>
                    <select class="form-control" name="type" required>
                        <option value="Male">Masculino</option>
                        <option value="Female">Femenino</option>
                    </select>
                </div>


                <div class="col-md-4">
                    <label for="">Deporte</label>
                    <select name="sport" required class="form-control">
                        @foreach($sports as $sport)

                            <option value="{{$sport -> id}}"> {{$sport -> name}}</option>

                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Prioridad</label>
                        <input type="number" class="form-control" name="priority" id="priority" aria-describedby="helpId"
                               placeholder="Ingrese el número de prioridad" value="5" max="100" min="-10" required>
                        <small id="helpId" class="form-text text-muted">Permite mostrar este torneo como principal en la página de inicio para los usuarios</small>
                    </div>
                </div>

            </div>
            {{--Reglas--}}
            <div class="form-group">
                <div class="form-group">
                    <label>Alguna breve descripción</label>
                    <textarea class="form-control" name="rules" rows="3"></textarea>
                </div>
            </div>

            {{--End--}}
            <div class="form-group">
                <input type="submit" value="Guardar" name="btn_save" class="btn btn-success">
            </div>


        </form>
    </div>
@endsection