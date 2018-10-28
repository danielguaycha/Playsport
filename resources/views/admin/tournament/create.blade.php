@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Crear Torneo</h3>
        <hr>
        <form action="{{route('tournament.store')}}" method="post">
            {{csrf_field()}}
            {{--Nombre--}}
            <div class="form-group">
                <label>Nombre</label>
                <input type="text"
                       class="form-control"
                       name="name" required placeholder="Ingrese nombre" maxlength="100">
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
                <div class="col-md-6">
                    <label>Género</label>
                    <select class="form-control" name="type" required>
                        <option value="Male">Masculino</option>
                        <option value="Female">Femenino</option>
                    </select>
                </div>


                <div class="col-md-6">
                    <label for="">Deporte</label>
                    <select name="sport" required class="form-control">
                        @foreach($sports as $sport)

                            <option value="{{$sport -> id}}"> {{$sport -> name}}</option>

                        @endforeach
                    </select>
                </div>

            </div>
            {{--Reglas--}}
            <div class="form-group">
                <div class="form-group">
                    <label>Reglas (.md)</label>
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