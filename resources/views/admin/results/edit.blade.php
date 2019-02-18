@extends('layouts.app')

@section('content')
    <div class="container" id="results">
        @include('layouts.notify')
        <div class="row">
            <div class="col-md-12 text-center">
                @switch($time_tables->status)
                    @case(-1)
                    <span class="badge badge-primary">Por jugarse</span>
                    @break
                    @case(0)
                    <span class="badge badge-success">En proceso</span>
                    @break
                    @case(1)
                    <span class="badge badge-dark">Finalizado</span>
                    @break
                    @case(2)
                    <span class="badge badge-secondary">Finalizado en penales</span>
                    @break
                @endswitch
            </div>
        </div>
        {{--Info General--}}
        <div class="row">
            {{--TEAN A--}}
            <div class="col text-center">
                {{--Icons and info--}}
                <div class="row">
                    <div class="col">
                        <h6>Equipo A | {{ $time_tables->team_a }}</h6>
                        <img src="{{ asset($time_tables->logo_a) }}" alt="" width="60px">
                    </div>
                </div>
            </div>
            {{--TEAM B--}}
            <div class="col text-center">
                {{--Icons and info--}}
                <div class="row">
                    <div class="col">
                        <h6>Equipo B | {{ $time_tables->team_b }}</h6>
                        <img src="{{ asset($time_tables->logo_b) }}" alt="" width="60px">
                    </div>
                </div>

            </div>
        </div>
        {{--GOLES - PENALES - GOLEADORES --}}
        <form action="{{ route('result.store') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="time_table_id" value="{{ $time_tables->id }}">
            <input type="hidden" name="group_id" value="{{ $time_tables->group_id }}">
            {{--Goleadores--}}
            <div><h6>Goles | Puntos</h6></div>
            <div class="row">
                <div class="col text-center">
                    <input type="number"
                           aria-valuemin="0"
                           name="result_a"
                           value="{{ $time_tables->result_a==null?'0':$time_tables->result_a }}"
                           class="form-control text-center">
                </div>
                <div class="col text-center">
                    <input type="number"
                           name="result_b"
                           value="{{ $time_tables->result_b==null?'0':$time_tables->result_b }}"
                           class="form-control text-center">
                </div>
            </div>
            <br>
            {{--Penales--}}
            <div><h6>Penales</h6></div>
            <div class="row">
                <div class="col text-center">
                    <input type="number"
                           aria-valuemin="0"
                           name="penal_a"
                           value="{{ $time_tables->penal_a==null?'0':$time_tables->penal_a }}"
                           class="form-control text-center">
                </div>
                <div class="col text-center">
                    <input type="number"
                           value="{{ $time_tables->penal_b==null?'0':$time_tables->penal_b }}"
                           name="penal_b"
                           class="form-control text-center">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="btn btn-dark"
                            name="btn_store"
                            value="update"
                            type="submit"><i class="fa fa-save"> </i>&nbsp;Actualizar Resultado</button>

                    @if($time_tables->group_id !=null && $time_tables->sport_id !=3)
                        <button type="submit"
                            name="btn_store"
                            value="end"
                            class="btn btn-danger"><i class="fa fa-stop-circle"> </i>&nbsp;Terminar Partido</button>
                    @endif

                    @if($time_tables->sport_id == 3)
                        <div class="form-inline text-center justify-content-center py-4">
                            <div class="form-group">
                                <label for="team_winner">¿Quien Ganó?&nbsp;&nbsp;</label>
                                <select name="team_winner" id="team_winner" class="form-control" required>
                                    <option disabled selected>Selecccione...</option>
                                    <option value="{{ $time_tables->team_id_a }}">{{ $time_tables->team_a }}</option>
                                    <option value="{{ $time_tables->team_id_b }}">{{ $time_tables->team_b }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                        name="btn_store"
                                        value="end_volley"
                                        class="btn btn-danger"><i class="fa fa-stop-circle"> </i>&nbsp;Terminar Partido</button>
                            </div>
                        </div>
                    @endif

                    @if($time_tables->group_id !=null)
                        <button type="submit"
                                name="btn_store"
                                value="revert"
                                class="btn btn-info"><i class="fa fa-backward"> </i>&nbsp;Revertir Stats</button>
                    @endif


                </div>
            </div>
        </form>

        <hr>
        <div class="col-md-12 text-center py-2">
            <form class="form-inline justify-content-center"
                  method="post"
                  action="{{ route('result.update.status', ['time_table_id'=> $time_tables->id]) }}">
                {{ csrf_field() }}
                <div class="form-group mr-2">
                    <button type="submit"
                            name="btn_status" value="-1" class="btn btn-secondary btn-sm">Por jugarse</button>
                </div>
                <div class="form-group mr-2">
                    <button type="submit"
                            name="btn_status" value="0" class="btn btn-secondary btn-sm">En proceso</button>
                </div>
                <div class="form-group mr-2">
                    <button type="submit"
                            name="btn_status" value="1" class="btn btn-secondary btn-sm">Finalizado</button>
                </div>
                <div class="form-group mr-2">
                    <button type="submit"
                            name="btn_status" value="2" class="btn btn-secondary btn-sm">Finalizado con penales</button>
                </div>
            </form>
        </div>

        {{--Goleadores--}}
        <hr>
        <div class="row">
            <div class="col">
                <h6>Stats | {{ $time_tables->team_a}}</h6>
                <form method="post" action="{{ route('result.store.stats') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="tournament_id" value="{{ $time_tables->tournament_id }}">
                    <input type="hidden" name="team_id" value="{{ $time_tables->team_id_a }}">
                    <input type="hidden" name="time_table_id" value="{{ $time_tables->id }}">

                    <div class="form-group">
                        <label>Jugador</label>
                        <select name="player_id" class="form-control" required>
                            @foreach($players['players_a'] as $p)
                                <option value="{{ $p->id }}">{{$p->number}}. {{ $p->last_name }} {{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Goles | Puntos</label>
                            <input type="number"
                                   name="goals"
                                   class="form-control form-control text-center" min="-3" max="20" required value="0">
                        </div>
                        <div class="col-md-4">
                            <label>Tarjetas amarillas</label>
                            <input type="number"
                                   name="yellow"
                                   class="form-control form-control text-center" min="-2" max="20" required value="0">
                        </div>
                        <div class="col-md-4">
                            <label>Tarjetas Rojas</label>
                            <input type="number"
                                   name="red"
                                   class="form-control form-control text-center" min="-1" max="20" required value="0">
                        </div>
                    </div>
                    <div class="form-group text-center pr-0">
                        <button type="submit"
                                style="background: {{ $time_tables->logo_a }}; border-color: {{ $time_tables->logo_a }}"
                                class="btn btn-dark"><i class="fa fa-plus-circle"></i>&nbsp;Agregar</button>
                    </div>
                </form>
            </div>
            <div class="col">
                <h6>Stats | {{ $time_tables->team_b}}</h6>
                <form method="post" action="{{ route('result.store.stats') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="tournament_id" value="{{ $time_tables->tournament_id }}">
                    <input type="hidden" name="team_id" value="{{ $time_tables->team_id_b }}">
                    <input type="hidden" name="time_table_id" value="{{ $time_tables->id }}">

                    <div class="form-group">
                        <label>Jugador</label>
                        <select name="player_id" class="form-control" required>
                            @foreach($players['players_b'] as $p)
                                <option value="{{ $p->id }}">{{$p->number}}. {{ $p->last_name }} {{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label>Goles | Puntos</label>
                            <input type="number"
                                   name="goals"
                                   class="form-control form-control text-center" min="-5" max="20" required value="0">
                        </div>
                        <div class="col-md-4">
                            <label>Tarjetas amarillas</label>
                            <input type="number"
                                   name="yellow"
                                   class="form-control form-control text-center" min="-2" max="20" required value="0">
                        </div>
                        <div class="col-md-4">
                            <label>Tarjetas Rojas</label>
                            <input type="number"
                                   name="red"
                                   class="form-control form-control text-center" min="-1" max="20" required value="0">
                        </div>
                    </div>
                    <div class="form-group text-center pr-0">
                        <button type="submit"
                                style="background: {{ $time_tables->logo_b }}; border-color: {{ $time_tables->logo_b }}"
                                class="btn btn-dark"><i class="fa fa-plus-circle"></i>&nbsp;Agregar</button>
                    </div>
                </form>
            </div>
        </div>
        {{--TABLA DE GOLEADOR--}}
        <div class="row">
            <div class="col table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>T.R.</th>
                        <th>T.A.</th>
                        <th>G.</th>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stats as $s)
                        @if($s->team_id == $time_tables->team_id_a)
                        <tr>
                            <td>#{{ $s->number }} {{ $s->last_name }} {{ substr($s->name, 0 ,1) }}.</td>
                            <td>{{ $s->red }}</td>
                            <td>{{ $s->yellow }}</td>
                            <td>{{ $s->goals }}</td>
                            <td>
                                <form action="{{ route('result.destroy.stats', ['id'=> $s->id]) }}" method="post" id="stat_{{ $s->id }}">
                                    {{ csrf_field() }}
                                    {{ method_field("DELETE") }}
                                    <button type="button"
                                            onclick="removeStat('stat_{{ $s->id }}')"
                                            class="btn btn-sm text-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>T.R.</th>
                        <th>T.A.</th>
                        <th>G.</th>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stats as $s)
                        @if($s->team_id == $time_tables->team_id_b)
                            <tr>
                                <td>#{{ $s->number }} {{ $s->last_name }} {{ substr($s->name, 0 ,1) }}.</td>
                                <td>{{ $s->red }}</td>
                                <td>{{ $s->yellow }}</td>
                                <td>{{ $s->goals }}</td>
                                <td>
                                    <form action="{{ route('result.destroy.stats', ['id'=> $s->id]) }}" method="post" id="stat_{{ $s->id }}">
                                        {{ csrf_field() }}
                                        {{ method_field("DELETE") }}
                                        <button type="button"
                                                onclick="removeStat('stat_{{ $s->id }}')"
                                                class="btn btn-sm text-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function removeStat(id){
            let c = confirm("Seguro deseas borar este stat ?");
            if (c)
                document.getElementById(id).submit();
        }
    </script>
@endsection