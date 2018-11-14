@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        @foreach($stage as $s)
            <div class="row">
                <div class="col-md-12 text-center">
                    @switch($s->status)
                        @case(-1)
                        <span class="badge badge-primary">Por jugarse</span>
                        @break
                        @case(0)
                        <span class="badge badge-success">En proceso</span>
                        @break
                        @case(1)
                        <span class="badge badge-secondary">Finalizado</span>
                        @break
                        @case(2)
                        <span class="badge badge-secondary">Finalizado en penales</span>
                        @break
                    @endswitch
                </div>
            </div>
            <div class="row">
                {{--TEAN A--}}
                <div class="col text-center">
                    {{--Icons and info--}}
                    <div class="row">
                        <div class="col">
                            <h6>Equipo A | {{ $s->team_a }}</h6>
                            @if($s->type_a == 'Male')
                                <img src="{{ Avatar::create($s->alias_a)
                                                ->setDimension(200)
                                                ->setFontSize(72)
                                                ->setBackground($s->logo_a)->toBase64() }}" width="60px"/>
                            @else
                                <img src="{{ Avatar::create($s->alias_a)
                                                    ->setBorder(5, "#C2185B")
                                                    ->setDimension(200)
                                                    ->setFontSize(72)
                                                    ->setBackground($s->logo_a)->toBase64() }}" width="60px"/>
                            @endif
                            <form class="form-inline py-3 text-center justify-content-center"
                                  action="{{ route("stage.change") }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="team" value="team_a">
                                <input type="hidden" name="team_old" value="{{ $s->team_id_a }}">
                                <input type="hidden" name="time_table_id" value="{{ $s->id }}">
                                <div class="form-group">
                                    <select name="team_new" id="team_a" class="form-control">
                                        @foreach($stats as $st)
                                            <option value="{{ $st->team_id }}">{{ $st->team }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                            style="background: {{ $s->logo_a }}"
                                            name="btn_set" value="update" class="btn btn-success"><i class="fa fa-check-circle"></i></button>
                                    <button type="submit" name="btn_set" value="revert_one" class="btn btn-warning text-white"><i class="fa fa-arrow-alt-circle-left"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{--TEAM B--}}
                <div class="col text-center">
                    {{--Icons and info--}}
                    <div class="row">
                        <div class="col">
                            <h6>Equipo B | {{ $s->team_b }}</h6>
                            @if($s->type_b == 'Male')
                                <img src="{{ Avatar::create($s->alias_b)
                                                ->setDimension(200)
                                                ->setFontSize(72)
                                                ->setBackground($s->logo_b)->toBase64() }}" width="60px"/>
                            @else
                                <img src="{{ Avatar::create($s->alias_b)
                                                    ->setBorder(5, "#C2185B")
                                                    ->setDimension(200)
                                                    ->setFontSize(72)
                                                    ->setBackground($s->logo_b)->toBase64() }}" width="60px"/>
                            @endif
                            <form class="form-inline py-3 text-center justify-content-center"
                                  action="{{ route("stage.change") }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="team" value="team_b">
                                <input type="hidden" name="team_old" value="{{ $s->team_id_b }}">
                                <input type="hidden" name="time_table_id" value="{{ $s->id }}">
                                <div class="form-group">
                                    <select name="team_new" id="team_b" class="form-control">
                                        @foreach($stats as $st)
                                            <option value="{{ $st->team_id }}">{{ $st->team }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                            style="background: {{ $s->logo_b }}"
                                            name="btn_set"
                                            value="update" class="btn btn-success"><i class="fa fa-check-circle"></i></button>
                                    <button type="submit" name="btn_set" value="revert_one" class="btn btn-warning text-white"><i class="fa fa-arrow-alt-circle-left"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row py-1">
                <div class="col text-center">
                    <a @auth href="{{route('result.edit', ['id'=> $s->id])}}" @endauth class="btn btn-info">Gestionar Resultado</a>
                </div>
            </div>
            <hr>
        @endforeach

        <div class="row py-4">
            @foreach($groups as $g)
                <div class="col-md-3">
                    <div>Grupo: {{ $g->name }}</div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>GD</th>
                            <th>PTS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stats as $s)
                            @if($s->group_id == $g->id)
                            <tr>
                                <td scope="row">{{ $s->team }}</td>
                                <td>{{ $s->gd }}</td>
                                <td>{{ $s->pts }}</td>
                            </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>

    </div>
@endsection