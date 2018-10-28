@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <h3>Editar Equipo</h3>
        <hr>
        <form action="{{route('team.update', ['id'=> $team->id])}}" method="post">
            {{ method_field("PUT") }}
            {{csrf_field()}}
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" maxlength="100"
                       class="form-control"
                       name="name"
                       value="{{ old('name', $team->name) }}"
                       placeholder="Ingresa un nombre">
            </div>

            <div class="form-group">
                <label for="alias">Alias</label>
                <input type="text" maxlength="50"
                       name="alias"
                       value="{{ old('alias', $team->alias ) }}"
                       placeholder="Ingrese un alias"
                       class="form-control">
            </div>

            <div class="form-group">
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


            <div class="form-group">
                <label for="">Seleccione Deporte</label>
                <select name="sport" required class="form-control">
                    @foreach($sports as $sport)
                        @if(old('sport'))
                            @if(old('sport')== $sport->id)
                                <option value="{{$sport -> id}}" selected> {{$sport -> name}}</option>
                            @else
                                <option value="{{$sport -> id}}"> {{$sport -> name}}</option>
                            @endif
                        @else
                            <option value="{{$sport -> id}}"> {{$sport -> name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>



            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>

        </form>
    </div>
@endsection