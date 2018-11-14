@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <div class="sp-title">
            <h3>Fechas para {{ $stage->name }} | <small>{{$tournament->name}}</small></h3>
            <h4>{{ $stage->match_num }} Encuentros</h4>
        </div>
        <form action="{{ route('timetable.store.stage') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" value="{{$tournament->id}}" name="tournament_id">
            <input type="hidden" value="{{ $tournament->sports_id }}" name="sport_id">
            <input type="hidden" value="{{ $tournament->type }}" name="type">
            <input type="hidden" value="{{ $stage->id }}" name="stage_id">
            <input type="hidden" value="{{ $stage->match_num }}" name="num">
            <div class="form-group row">
                <div class="col-md-4">
                    <label>Lugar</label>
                    <input type="text"
                           class="form-control" value="Cancha" name="place" required maxlength="50">
                </div>
                <div class="col-md-4">
                    <label>Hora</label>
                    <input type="time"
                           class="form-control" name="hour" required value="11:00">
                </div>
                <div class="col-md-4">
                    <label>Fecha</label>
                    <input type="date"
                           class="form-control" name="date" required value="2018-11-15">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Equipo Temporal A</label>
                    <input type="text" class="form-control" name="team_a" required>
                </div>
                <div class="col-md-6">
                    <label for="">Equipo Temporal B</label>
                    <input type="text" class="form-control" name="team_b" required>
                </div>
            </div>
            <div class="form-group text-center"><br>
                <input type="submit" class="btn-success btn" value="Agregar">
            </div>
        </form>
        <br>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Equipo A</th>
                        <th>Equipo B</th>
                        <th>Fecha | Hora</th>
                        <th>Lugar</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($timeTables as $tt)
                        <tr>
                            <td>{{$tt->team_a}}</td>
                            <td>{{$tt->team_b}}</td>
                            <td>{{$tt->date}} | {{$tt->hour}}</td>
                            <td>{{$tt->place}}</td>
                            <th>
                                <form class="d-inline-block"
                                      action="{{route("timetable.destroy", ["id"=> $tt->id])}}" method="get" id="tt_{{$tt->id}}">
                                    {{csrf_field()}}
                                    <button type="button" @click.prevent="delTimeTable('tt_{{$tt->id}}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                                <a href="{{ route('timetable.edit', ['id'=> $tt->id, 'group_id'=> $tt->group_id ]) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection