@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <div class="sp-title">
            <h4>Modificacion de horarios</h4>
            <h5>{{ $table->title }}</h5>
            <h5>{{ $table->torneo }}</h5>
        </div>
        <hr>
        <div class="row">
            {{--TEAN A--}}
            <div class="col text-center">
                {{--Icons and info--}}
                <div class="row">
                    <div class="col">
                        <h6>Equipo A | {{ $table->team_a }}</h6>
                        @if($table->type_a == 'Male')
                            <img src="{{ Avatar::create($table->alias_a)
                                            ->setDimension(200)
                                            ->setFontSize(72)
                                            ->setBackground($table->logo_a)->toBase64() }}" width="60px"/>
                        @else
                            <img src="{{ Avatar::create($table->alias_a)
                                                ->setBorder(5, "#C2185B")
                                                ->setDimension(200)
                                                ->setFontSize(72)
                                                ->setBackground($table->logo_a)->toBase64() }}" width="60px"/>
                        @endif
                    </div>
                </div>
            </div>
            {{--TEAM B--}}
            <div class="col text-center">
                {{--Icons and info--}}
                <div class="row">
                    <div class="col">

                        <h6>Equipo B | {{ $table->team_b }}</h6>
                        @if($table->type_b == 'Male')
                            <img src="{{ Avatar::create($table->alias_b)
                                            ->setDimension(200)
                                            ->setFontSize(72)
                                            ->setBackground($table->logo_b)->toBase64() }}" width="60px"/>
                        @else
                            <img src="{{ Avatar::create($table->alias_b)
                                                ->setBorder(5, "#C2185B")
                                                ->setDimension(200)
                                                ->setFontSize(72)
                                                ->setBackground($table->logo_b)->toBase64() }}" width="60px"/>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        <hr>
        <form action="{{ route('timetable.update', ['id'=> $table->id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field("PUT") }}
            <div class="form-group row">
                <div class="col-md-4">
                    <label>Lugar</label>
                    <input type="text"
                           class="form-control" value="{{ old('place', $table->place) }}" name="place" required maxlength="50">
                </div>
                <div class="col-md-4">
                    <label>Hora</label>
                    <input type="time"
                           class="form-control" name="hour" required value="{{ old('hour', $table->hour) }}">
                </div>
                <div class="col-md-4">
                    <label>Fecha</label>
                    <input type="date"
                           class="form-control" name="date" required value="{{ old('date', $table->date ) }}">
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-info">Actualizar</button>
            </div>
        </form>
    </div>
@endsection