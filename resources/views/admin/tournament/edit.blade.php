@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <h3>Editar Torneo</h3>
        <hr>
        <form action="{{route('tournament.update', ['id'=> $tournament->id])}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field("PUT")}}
            {{--Nombre--}}
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text"
                           value="{{old('name', $tournament->name )}}"
                           class="form-control"
                           name="name" required placeholder="Ingrese nombre" maxlength="100">
                </div>
                <div class="col-md-6">
                    <label>Url</label>
                    <input type="text"
                           value="{{old('url', $tournament->url )}}"
                           class="form-control"
                           name="url" required placeholder="Url de acceso" maxlength="100">
                </div>
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
                <div class="col-md-4">
                    <label>Género</label>
                    <select class="form-control" name="type" required>
                        @if(old('type')=='Male' || $tournament->type == 'Male')
                            <option value="Male" selected>Masculino</option>
                            <option value="Female">Femenino</option>
                        @else
                            <option value="Male">Masculino</option>
                            <option value="Female" selected>Femenino</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Deporte</label>
                    <select class="form-control" name="sport_id" required>
                        @foreach($sports as $sport)
                            @if($sport->id == old('sport_id') || $tournament->sports_id == $sport->id)
                                <option value="{{$sport -> id}}" selected> {{$sport -> name}}</option>
                            @else
                                <option value="{{$sport -> id}}"> {{$sport -> name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Prioridad</label>
                        <input type="number" class="form-control" name="priority" id="priority" aria-describedby="helpId"
                               placeholder="Ingrese el número de prioridad" value="{{ $tournament->priority }}" max="100" min="-10" required>
                        <small id="helpId" class="form-text text-muted">Permite mostrar este torneo como principal en la página de inicio para los usuarios</small>
                    </div>
                </div>
            </div>
            {{--Logo--}}
            <div class="form-group row">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="{{ asset($tournament->logo) }}" class="mr-2">
                    <label>Cambiar?</label>
                    <input type="checkbox" name="change" id="change">
                </div>
                <div class="col-md-8">
                    <label for="">Logo</label>
                    <input type="file" class="form-control-file" disabled="disabled" name="logo" placeholder="Escoja un logo"
                           aria-describedby="fileHelpId" id="logo">
                    <small id="fileHelpId" class="form-text text-muted">Tamaño 100x100 pixeles</small>
                </div>
            </div>
            {{--Reglas--}}
            <div class="form-group">
                <div class="form-group">
                    <label>Descripción </label>
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


@section('script')
    <script>
        $('#change').click(function(){
            if (document.getElementById('change').checked)
            {
                $('#logo').prop("disabled", false);
            }else{
                $('#logo').prop("disabled", true);
            }
        });

    </script>
@endsection