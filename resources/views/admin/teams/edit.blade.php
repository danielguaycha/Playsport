@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <h3>Editar Equipo</h3>
        <hr>
        <form action="{{route('team.update', ['id'=> $team->id])}}" method="post">
            {{ method_field("PUT") }}
            {{csrf_field()}}
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text" maxlength="100"
                           class="form-control"
                           name="name"
                           value="{{ old('name', $team->name) }}"
                           placeholder="Ingresa un nombre">
                </div>
                <div class="col-md-6">
                    <label for="alias">Alias</label>
                    <input type="text" maxlength="3"
                           name="alias"
                           value="{{ old('alias', $team->alias ) }}"
                           placeholder="Ingrese un alias, Max.3"
                           class="form-control">
                </div>

            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label>Género</label>
                    <select class="form-control"
                            name="type">
                        @if($team->type == 'Female')
                            <option value="Male">Masculino</option>
                            <option value="Female" selected>Femenino</option>
                        @else
                            <option value="Male" selected>Masculino</option>
                            <option value="Female">Femenino</option>
                        @endif
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="">Seleccione Deporte</label>
                    <select name="sport" required class="form-control">
                        @foreach($sports as $sport)
                            @if(old('sport')== $sport->id || $team->sport_id == $sport->id)
                                <option value="{{$sport -> id}}" selected> {{$sport -> name}}</option>
                            @else
                                <option value="{{$sport -> id}}"> {{$sport -> name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="">Color</label>
                    <input type="color" class="form-control"
                           value="{{ old( 'color', $team->color) }}"
                           name="color" placeholder="Formato: #00000" id="color">
                </div>
                <div class="col-md-2 d-flex align-items-center justify-content-center">
                    <img src="{{ asset($team->logo) }}" class="mr-2">
                    <label>Cambiar?</label>
                    <input type="checkbox" name="change" id="change">
                </div>
                <div class="col-md-4">
                    <label for="">Logo</label>
                    <input type="file" class="form-control-file" disabled="disabled" name="logo" placeholder="Escoja un logo"
                           aria-describedby="fileHelpId" id="logo">
                    <small id="fileHelpId" class="form-text text-muted">Tamaño 100x100 pixeles</small>
                </div>
            </div>

            <div class="form-group mt-5">
                <button type="submit" class="btn btn-success">Guardar</button>
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