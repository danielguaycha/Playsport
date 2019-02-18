@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <div class="sp-title mb-3">
            <h3>Liga: {{ $league->name }}</h3>
            @include('admin.tournament._back', ['tournament_id'=>$league->tournament_id ])
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach($rounds as $r)
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>{{ $r->name }}
                            <small>| @if($r->status==0) En proceso @else Concluido @endif</small>
                        </h5>
                        <div class="d-flex">
                            @if($r->status == 0)
                            <button class="btn btn-sm btn-outline-info btnUpdate mr-2"
                                    data-target="#round_{{$r->id}}"><i class="fa fa-sync">&nbsp;</i>Actualizar</button>
                            @endif

                            <form action="{{ route('round.update', ['id'=> $r->id]) }}" method="post">
                                {{ csrf_field() }}
                                {{--Status>>-2 Pospuesto | -1: Por jugarse | 0: En proceso | 1: Finalizado | 2: Finalizado en penales--}}
                                @if($r->status == 1)
                                    <button class="btn btn-sm btn-outline-danger"
                                            value="in_game"
                                            name="opc"><i class="fa fa-long-arrow-alt-left">&nbsp;</i>Está en proceso</button>
                                @else
                                    <button class="btn btn-sm btn-outline-dark"
                                            value="end_game"
                                            name="opc"><i class="fa fa-hourglass-end ">&nbsp;</i>Ha concluido</button>
                                @endif
                            </form>

                        </div>
                    </div>
                    <div class="card-body table-responsive @if($r->status == 1) bw @endif">
                        <table class="table table-borderless">
                            <tbody class="round" id="round_{{$r->id}}">
                                @foreach($time_tables as $tt)
                                    @if($tt->round_id == $r->id)
                                        @if($tt->team_a != null and $tt->team_b !=null)
                                        <tr>
                                            <td class="text-center tb-border">
                                                <img src="{{ asset($tt->logo_a) }}" width="35px" class="rounded-circle">
                                                {{ $tt->team_a }}
                                            </td>
                                            <td width="8%" class="text-center tb-border">
                                                @switch($tt->status)
                                                    @case(-2)
                                                    <span class="badge badge-dark">Pospuesto</span>
                                                    @break
                                                    @case(-1)
                                                    <span class="badge badge-primary">Por jugarse</span>
                                                    @break
                                                    @case(0)
                                                    <span class="badge badge-success">En proceso</span>
                                                    @break
                                                    @case(1)
                                                    <span class="badge badge-danger">Finalizado</span>
                                                    @break
                                                    @case(2)
                                                    <span class="badge badge-secondary">Finalizado en penales</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td class="text-center tb-border">
                                                <img src="{{ asset($tt->logo_b) }}" width="35px" class="rounded-circle">
                                                {{ $tt->team_b }}
                                            </td>
                                            @if($tt->status!=-2)
                                                <td width="35%">
                                                    <div class="d-flex vs">
                                                        <input type="hidden"
                                                               data-id="time_table_id"
                                                               value="{{ $tt->id }}">
                                                        <input type="date"
                                                               value="{{ $tt->date }}"
                                                               data-id="date"
                                                               class="form-control" placeholder="Fecha">
                                                        <input type="time"
                                                               value="{{ $tt->hour }}"
                                                               data-id="hour" class="form-control" placeholder="Hora">
                                                    </div>

                                                </td>
                                                <td>
                                                    <a href="{{ route('result.edit', ['id'=> $tt->id]) }}"
                                                       data-placement="top" title="Jugar"
                                                       class="btn btn-sm btn-light btn-tooltip"><i class="fa fa-play"></i></a>
                                                    <button data-timetable="{{ $tt->id }}"
                                                            data-round="{{ $r->id }}"
                                                            data-placement="top" title="Postergar"
                                                            class="btn btn-sm btn-danger btn-tooltip postergar"><i class="fa fa-ban"></i>
                                                    </button>
                                                </td>
                                            @else
                                                <td>
                                                    {{--Formulario para posponer partidos--}}
                                                    <form method="post"
                                                          action="{{ route('postponed.destroy', ['time_table_id'=>$tt->id]) }}"
                                                          id="postponed_{{$tt->id}}"
                                                          class="form-confirm">
                                                        {{ csrf_field() }}
                                                        <button type="submit"
                                                           data-placement="right" title="Cancelar partido Pospuesto"
                                                           class="btn btn-sm btn-warning btn-tooltip"><i class="fa fa-backspace"> </i> Cancelar</button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
                                        @else
                                            <tr class="text-center">
                                                @if($tt->team_a != null)
                                                    <td colspan="3">
                                                        <img class="bw rounded-circle" src="{{ asset($tt->logo_a) }}" width="35px">
                                                        {{ $tt->team_a }} <small>| Descansa</small>
                                                    </td>
                                                @else
                                                    <td colspan="3">
                                                        <img class="bw rounded-circle" src="{{ asset($tt->logo_b) }}" width="35px">
                                                        {{ $tt->team_b }} <small>| Descansa</small>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    {{--Modal de postergaciones--}}
    <div class="modal fade" id="postergar" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form class="modal-content"
                  enctype="multipart/form-data"
                  method="post" action="{{ route('league.postponed') }}">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Gestión de postergación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        {{ csrf_field() }}
                        <input type="hidden" id="time_table_id" name="time_table_id" value="0">
                        <input type="hidden" id="team_a" name="team_a" value="0">
                        <input type="hidden" id="team_b" name="team_b" value="0">
                        <input type="hidden" id="round_from" name="round_from" value="0">
                        <div class="form-group">
                            <label for="">Seleccione hasta que ronda desea postergar</label>
                            <select class="form-control" name="round_to" required>
                                @foreach($rounds as $r)
                                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ">
                            <label>Fecha / Hora</label>
                            <div class="d-flex">
                                <input type="date" name="date" class="form-control" placeholder="">
                                <input type="time" name="hour" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Justificación</label>
                            <textarea class="form-control" required name="description" rows="2"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Imagen Adjunta</label>
                            <input type="file" class="form-control-file" name="image" accept="image/x-png,image/jpeg">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>

    </div>
@endsection
@section('script')
    <script>

        $('.postergar').click(function () {
            $('#postergar').modal('show');
            $('#time_table_id').val($(this).data('timetable'));
            $('#round_from').val($(this).data('round'));
        });

        $('.btnUpdate').click(function () {
            let data = [];
            $($(this).data('target')).find('.vs').each(function (i) {
                let timeTable = {};
                $(this).find('input').each(function () {
                    timeTable[$(this).data('id')] = $(this).val();
                });
                data.push(timeTable);
            });


            fetch('/api/timetable/update', {
                method: 'POST', // or 'PUT'
                body: JSON.stringify({times: data}),
                headers:{
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json())
                .catch(error => console.error('Error:', error))
                .then(response => {
                    ok(response.msg);
                });
        })
    </script>
@endsection
@section('style')
    <style>
        .tb-border{
            border-bottom: 1px solid #ccc !important;
        }
    </style>
@endsection