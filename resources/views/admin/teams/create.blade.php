@extends('layouts.app')
@section('content')
    <div class="container">
        @include('layouts.notify')
        <h3>Agregar Equipo</h3>
        <hr>
        <form action="{{route('team.store')}}" method="post" enctype="multipart/form-data">

            {{csrf_field()}}
            <div class="form-group row">
                <div class="col-md-6">
                    <label>Nombre</label>

                    <input type="text" maxlength="100"
                           class="form-control"
                           name="name"
                           required
                           value="{{ old('name') }}"
                           placeholder="Ingresa un nombre">
                </div>
                <div class="col-md-6">
                    <label for="alias">Alias</label>
                    <input type="text" maxlength="2"
                           name="alias"
                           value="{{ old('alias') }}"
                           placeholder="Ingrese un alias Max. 2 caracteres"
                           class="form-control">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-md-4">
                    <label>Género</label>
                    @if(request()->query('type'))
                        <select class="form-control"
                                name="type">
                            @if(request()->query('type')=='Male')
                                <option value="Male">Masculino</option>
                            @else
                                <option value="Female">Femenino</option>
                            @endif
                        </select>
                    @else
                        <select class="form-control"
                                name="type">
                            <option value="Male">Masculino</option>
                            <option value="Female">Femenino</option>
                        </select>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="">Deporte</label>
                    <select name="sport" required class="form-control" @if(request()->query('sport'))  @endif>
                        @if(request()->query('sport'))
                            @foreach($sports as $sport)
                                @if(request()->query('sport')==$sport->name)
                                    <option value="{{$sport -> id}}" selected> {{$sport -> name}}</option>
                                @endif
                            @endforeach
                        @else
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
                        @endif
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Color</label>
                    <input type="color" class="form-control" name="color" value="#00466f" id="color">
                </div>
            </div>

            <div class="form-group row">

                <div class="col-md-6">
                    <label>Torneo: </label>
                    <select class="form-control"
                            name="tournament_id">
                        @foreach($tournaments as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6" style="overflow: hidden;">
                    <label for="">Logo</label>
                    <input type="file" class="form-control-file" name="logo" placeholder="Escoja un logo"
                           aria-describedby="fileHelpId">
                    <small id="fileHelpId" class="form-text text-muted">Tamaño 100x100 pixeles</small>
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

        if(opener!=null){
            window.onunload = refreshParent;
            function refreshParent() {
                window.opener.location.reload();
            }
        }


    </script>
@endsection