@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="sp-title">
            <h3>Registro de Fechas</h3>
        </div>
        
        @if(isset($message))
            <div class="alert alert-info" role="alert">
                <strong>{{$message}}</strong>}
            </div>
        @endif
        
        @if(!request()->query("tournament"))
            <form method="get">
                <div class="form-group">
                    <label>Seleccione Torneo</label>
                    <select name="tournament" class="form-control">
                        @foreach($tournaments as $t)
                            <option value="{{$t->id}}">{{$t->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Siguiente" class="btn btn-info">
                </div>
            </form>

        @else
            @if(isset($groups) && !request()->query('group'))
                <form action="">
                    <h5><span class="text-info">Torneo: </span>{{ $tournament->name }}</h5>
                    <input type="hidden" name="tournament" value="{{$tournament->id}}">
                    <div class="form-group">
                        <label for="">Seleccione el grupo</label>
                        <select class="form-control" name="group">
                            @foreach($groups as $g)
                                <option value="{{$g->id}}">{{$g->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Siguiente" class="btn btn-info">
                    </div>
                </form>
            @endif

            @if(isset($stages) && !request()->query('stage'))
                <form action="">
                    <h5><span class="text-info">Torneo: </span>{{ $tournament->name }}</h5>
                    <input type="hidden" name="tournament" value="{{$tournament->id}}">
                    <div class="form-group">
                        <label for="">Seleccione la Etapa</label>
                        <select class="form-control" name="stage">
                            @foreach($stages as $s)
                                <option value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Siguiente" class="btn btn-info">
                    </div>
                </form>
            @endif
        @endif
    </div>
@endsection