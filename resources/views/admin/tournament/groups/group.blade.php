@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <div class="sp-title mb-3">
            <h3>Gestión de Grupos</h3>
            @include('admin.tournament._back', ['tournament_id'=>$tournament_id ])
        </div>
        @if(count($groups)>0)
            <div>
                @foreach($groups as $g)
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5>Grupo # {{ $g->name }}</h5>
                            <div class="d-flex">
                                <form action="{{route("group.destroy", ['id'=> $g->id])}}"
                                      class="d-inline-block form-confirm" id="g_{{$g->id}}"
                                      data-msg="¿Está seguro que desea eliminar este grupo?"
                                      method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i></button>
                                </form>
                                <button class="btn btn-sm btn-primary btnUpdate ml-2"
                                        data-target="#group_{{$g->id}}">Actualizar Fechas</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody class="round" id="group_{{ $g->id }}">
                                @foreach($dates[$g->id] as $date)
                                    @if($date->group_id == $g->id)
                                        <tr>
                                            @foreach($teams as $t)
                                                @if($t->id == $date->team_id_a)
                                                    <td>
                                                    <img class="rounded-circle" src="{{ asset($t->logo) }}" width="30px">
                                                    {{ $t->name }}
                                                    </td>
                                                @endif
                                                @if($t->id == $date->team_id_b)
                                                    <td>
                                                        <img class="rounded-circle" src="{{ asset($t->logo) }}" width="30px">
                                                            {{ $t->name }}
                                                    </td>
                                                @endif
                                            @endforeach
                                                <td width="8%" class="text-center tb-border">
                                                    @switch($date->status)
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
                                                <td width="35%">
                                                    <div class="d-flex vs">
                                                        <input type="hidden"
                                                               data-id="time_table_id"
                                                               value="{{ $date->id }}">
                                                        <input type="date"
                                                               value="{{ $date->date }}"
                                                               data-id="date"
                                                               class="form-control" placeholder="Fecha">
                                                        <input type="time"
                                                               value="{{ $date->hour }}"
                                                               data-id="hour" class="form-control" placeholder="Hora">
                                                    </div>
                                                </td>
                                            <td>
                                                <a href="{{ route('result.edit', ['id'=> $date->id]) }}"
                                                   data-placement="top" title="Jugar"
                                                   class="btn btn-sm btn-light btn-tooltip"><i class="fa fa-play"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endforeach
            </div>
        @else
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Ey!</strong> Aún no se han creado grupos
            </div>

            <script>
                $(".alert").alert();
            </script>
        @endif

    </div>
@endsection
@section('script')
    <script>
        $('.btnUpdate').click(function () {
            let data = [];
            $($(this).data('target')).find('.vs').each(function (i) {
                let timeTable = {};
                $(this).find('input').each(function () {
                    timeTable[$(this).data('id')] = $(this).val();
                });
                data.push(timeTable);
            });
            //console.log(data);
            $(this).html('Actualizando...');
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
                    $(this).html('Actualizar Fechas');
                });
        })
    </script>
@endsection