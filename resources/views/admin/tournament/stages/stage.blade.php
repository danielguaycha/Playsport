@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <div class="sp-title">
            <h3>Creación de Eliminatoria</h3>
        </div>
        @if(request()->query('type') && request()->query('defined'))
            <div class="alert alert-info" role="alert">
                <strong>Info!</strong> Para crear esta eliminatoria necesitas <b>{{ $num }}</b> equipos.
            </div>
            <form action="{{ route('stage.store') }}" method="post" id="form-list">
                <input type="hidden" value="{{ $num }}" name="num">
                <input type="hidden" value="{{ $tournament->id }}" name="tournament_id">
                {{ csrf_field() }}
                <div class="list-selects">
                    <div class="subject-info-box-1">
                        <label for="listBox1">Seleccione los Equipos</label>
                        <select multiple="multiple" id='lstBox1'
                                size="10"
                                class="form-control" name="teams_all" title="Valor">
                            @foreach($teams as $team)
                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                        </select>
                    </div>
                    <div class="subject-info-arrows text-center">
                        <button type="button" id="btnAllRight" class="btn btn-secondary mb-2" >
                            <i class="fa fa-arrow-right"></i><br>
                            <i class="fa fa-arrow-right"></i>
                        </button><br>
                        <button type="button" id="btnRight" value=">" class="btn btn-info">
                            <i class="fa fa-arrow-right"></i>
                        </button><br />
                        <button type="button" id="btnLeft" value="<" class="btn btn-success" >
                            <i class="fa fa-arrow-left"></i>
                        </button><br />
                        <button type="button" id="btnAllLeft" value="<<" class="btn btn-secondary mt-2">
                            <i class="fa fa-arrow-left"></i><br>
                            <i class="fa fa-arrow-left"></i>
                        </button>
                    </div>
                    <div class="subject-info-box-2">
                    <label for="listBox1">Equipos Seleccionados</label>
                    <select multiple
                            title="Seleccionados"
                            size="10"
                            id='lstBox2' class="form-control"  name="to_team[]">
                    </select>
                </div>
                </div>
                <div class="form-group text-center mt-5">
                    <input type="button" value="Confirmar" class="btn btn-primary" id="btnSubmit">
                </div>
            </form>

        @elseif(request()->query('tournament'))
            <div>
                <div class="row mt-4">
                    {{--<div class="col-md-3 stage-box">
                        <div>
                            <h5>Octavos de Final</h5>
                            <figure>
                                <img src="{{ asset('img/octavos.png') }}" >
                            </figure>
                            <form method="get">
                                <input type="hidden" name="tournament" value="{{ $tournament->id }}">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="true" name="defined" id="defined">
                                    <label class="form-check-label" for="defined">
                                        Definir Equipos
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary" name="type" value="8">Crear</button>
                            </form>
                        </div>
                    </div>--}}
                    {{--Cuartos de Final--}}
                    {{--<div class="col-md-3 stage-box">
                        <div>
                            <h5>Cuartos de Final</h5>
                            <figure>
                                <img src="{{ asset('img/cuartos.png') }}">
                            </figure>
                            <form method="get">
                                <div class="form-check">
                                    <input type="hidden" name="tournament" value="{{ $tournament->id }}">
                                    <input class="form-check-input" type="checkbox" value="true" name="defined" id="defined-4">
                                    <label class="form-check-label" for="defined-4">
                                        Definir Equipos
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary" name="type" value="4">Crear</button>
                            </form>
                        </div>
                    </div>--}}
                    <div class="col-md-6 stage-box">
                        <div>
                            <h5>SemiFinal</h5>
                            <figure>
                                <img src="{{ asset('img/semifinal.png') }}">
                            </figure>
                            <form method="get" class="text-center">
                                <div class="form-check d-none">
                                    <input type="hidden" name="tournament" value="{{ $tournament->id }}">
                                    <input class="form-check-input" type="checkbox" value="true"
                                           checked="checked"
                                           name="defined" id="defined-2">
                                    <label class="form-check-label" for="defined-2">
                                        Definir Equipos
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary" name="type" value="2">Crear</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 stage-box">
                        <div>
                            <h5>Final</h5>
                            <figure>
                                <img src="{{ asset($tournament->logo) }}" width="50px" class="rounded-circle img-thumbnail">
                            </figure>
                            <form method="get" class="text-center">
                                <div class="form-check d-none">
                                    <input type="hidden" name="tournament" value="{{ $tournament->id }}">
                                    <input class="form-check-input" type="checkbox" value="true"
                                           checked="checked"
                                           name="defined" id="defined-1">
                                    <label class="form-check-label" for="defined-1">
                                        Definir Equipos
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary" name="type" value="1">Crear</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @include('admin.tournament._back', ['tournament_id'=>$tournament->id ])
    </div>
@endsection
@section('script')
    {{--Para mover los datos de la lista--}}
    @include('admin.partials._list-script')
    <script>
        $('#btnSubmit').click(function (e) {
            $('#lstBox2 option').prop('selected', true);
            if($('#lstBox2 option:selected').length>0){
                $('#form-list').submit();
            }else{
                alert('Selecciona los equipos necesarios')
            }
        })
    </script>
@endsection