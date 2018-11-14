@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.notify')
        <h3>Agregar Equipo</h3>
        <hr>
        <form action="{{route('team.store')}}" method="post">

            {{csrf_field()}}
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Nombre</label>

                    <input type="text" maxlength="100"
                           class="form-control"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Ingresa un nombre">
                </div>
                <div class="col-md-6">
                    <label for="alias">Alias</label>
                    <input type="text" maxlength="50"
                           name="alias"
                           value="{{ old('alias') }}"
                           placeholder="Ingrese un alias"
                           class="form-control">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-md-6">
                    <label>Género</label>
                    <select class="form-control"
                            name="type">
                        <option value="Male">Masculino</option>
                        <option value="Female">Femenino</option>
                    </select>
                </div>
                <div class="col-md-6">
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

            </div>

            <div class="form-group row">
                <div class="col-md-3">
                    <label for="">Color</label>
                    <input type="color" class="form-control" name="logo" value="#00466f" id="color">
                </div>
                <div class="col-md-9">
                    <div class="form-inline">
                        @foreach($colors as $c)
                            <button type="button"
                                    onclick="colors('{{$c->logo}}')"
                                    class="btn btn-sm"
                                    style="margin: 1rem; background: {{ $c->logo }}; color: #fff">{{ $c->alias }}-{{ $c->logo }}</button>
                        @endforeach
                    </div>
                </div>

            </div>







            <div class="form-group">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>

        </form>
    </div>
@endsection

@section('script')
    <script>
        function colors(valor){
            document.getElementById('color').value = valor;
        }
    </script>
@endsection