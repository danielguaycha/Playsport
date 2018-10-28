@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <h3>Editar Torneo</h3>
        <hr>
        <form action="{{route('tournament.update', ['id'=> $tournament->id])}}" method="post">
            {{csrf_field()}}
            {{method_field("PUT")}}
            {{--Nombre--}}
            <div class="form-group">
                <label>Nombre</label>
                <input type="text"
                       value="{{old('name', $tournament->name )}}"
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
                           value="{{ old('date_init', $tournament->date_init) }}"
                           name="date_init" placeholder="Fecha de inicio">
                </div>
                <div class="col-md-6">
                    <label>Fecha de fin</label>
                    <input type="date"
                           class="form-control"
                           required
                           value="{{ old('date_end', $tournament->date_end) }}"
                           name="date_end" placeholder="Fecha de Fin">
                </div>
            </div>
            {{--Genero y Deporte--}}
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Género</label>
                    <select class="form-control" name="type" required>
                        <option value="male">Masculino</option>
                        <option value="female">Femenino</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Deporte</label>
                    <select class="form-control" name="sport_id" required>
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
                    <textarea class="form-control" name="rules" rows="3">{{$tournament->rules}}</textarea>
                </div>
            </div>

            {{--End--}}
            <div class="form-group">
                <input type="submit" value="Guardar" name="btn_save" class="btn btn-success">
            </div>


        </form>
    </div>
@endsection