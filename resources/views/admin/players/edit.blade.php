@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <h3>Editar jugador</h3>
        <hr>
        <form action="{{route("player.update", ['id'=>$player->id])}}" method="post">
            {{csrf_field()}}
            {{method_field("PUT")}}
            {{--Campos basicos--}}
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text"
                           name="name"
                           value="{{  old('name', $player->name) }}"
                            required
                           maxlength="100"
                           class="form-control" placeholder="Ingrese nombre">
                </div>
                <div class="col-md-6">
                    <label>Apellido</label>
                    <input type="text"
                           name="last_name"

                           value="{{ $player->last_name }}"
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
                           value="{{ $player->dni }}"
                           maxlength="20"
                           required
                           placeholder="Ingrese Dni"
                           class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Edad</label>
                    <input type="number"
                           name="age"
                           required
                           value="{{ $player->age }}"
                           placeholder="Ingrese edad"
                           class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label>Genero</label>
                <select name="type" class="form-control" required>
                    @if($player->type == 'Female')
                        <option value="Male">Masculino</option>
                        <option value="Female" selected>Femenino</option>
                    @else
                        <option value="Male" selected>Masculino</option>
                        <option value="Female">Femenino</option>
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label>Observaciones</label>
                <textarea name="observations" cols="30" rows="5" class="form-control">{{ $player->observations}}</textarea>
                <br>
                <input type="submit" value="Actualizar" class="btn btn-info">
            </div>
        </form>
    </div>
@endsection