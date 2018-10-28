@extends('layouts.app')

@section('content')
    <div class="container" id="grupos">
        @include('layouts.notify')
        <div class="sp-title">
            <h3>Crear Grupos</h3>
        </div>

        @if(!request()->get('tournament'))
            <form method="get">
            <div class="form-group">
                <label for="">Torneo al que pertenece el grupo</label>
                <select class="form-control" name="tournament" id="" v-model="tournaments">
                    @foreach($tournaments as $t)
                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Seleccionar" class="btn btn-success">
            </div>
        </form>
        @else

            {{--Informacion del torneo que se selecciono--}}
            <div class="d-flex justify-content-between">
                <h5>Torneo: <span class="text-info">{{ $tournaments->name }}</span></h5>
                <h5>Tipo: <span class="text-info">{{ $tournaments->type }}</span></h5>
                <h5>Deporte: <span class="text-info">{{ $sport->name }}</span></h5>
            </div>

            {{--Formulario de registro de grupos--}}
            <form action="{{route('group.store')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="tournament_id" value="{{$tournaments->id}}">
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="Ingrese nombre" required maxlength="50">
                </div>
                <div class="form-group row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Seleccione equipos</label>
                            <select multiple class="custom-select" v-model="from_team" name="from_team" id="from_team">
                                @foreach($teams as $tm)
                                    @if($tm->group_id!=null)
                                        <option class="disabled text-danger" disabled value="{{$tm->id}}">{{$tm->name}}</option>
                                    @else
                                        <option value="{{$tm->id}}">{{$tm->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--Buttons--}}
                    <div class="col-md-2">
                        <div class="sp-arrows">

                            <button class="btn btn-success" @click.prevent="addItem">
                                <i class="fa fa-long-arrow-alt-right"></i>
                            </button>

                            <button class="btn btn-info" @click.prevent="deleteItem">
                                <i class="fa fa-long-arrow-alt-left"></i>
                            </button>


                        </div>
                    </div>
                    {{-- To send --}}
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="">Equipos seleccionados</label>
                            <select multiple class="custom-select" id="to_team" name="to_team[]" required>
                                {{--@foreach($filter_teams as $tm)
                                    <option value="{{$tm->id}}">{{$tm->name}}</option>
                                @endforeach--}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <input type="submit" value="Guardar" class="btn btn-success">
                </div>
            </form>

            {{--Lista de grupos para este torneo--}}
            <hr>
            <div class="sp-title">
                <h3>Grupos</h3>
            </div>
            @if(count($groups)<=0)
                <div class="alert alert-info" role="alert">
                    <strong>Aún no se han creado grupos para este torneo</strong>
                </div>
            @endif
            <table class="table table-borderless">
                <tbody>
                @foreach($groups as $g)
                    <tr class="text-center" style="border-bottom: 2px solid #dc3545">
                        <td colspan="2">
                            Grupo: <b>{{ $g->name }}</b>  |
                            <form @submit.prevent="deleteGroup('g_{{$g->id}}')"
                                  action="{{route("group.destroy", ['id'=> $g->id])}}"
                                  class="d-inline-block" id="g_{{$g->id}}">
                                <button type="submit" class="btn btn-link text-danger"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @foreach($teams as $t)
                        <tr>
                        @if($t->group_id == $g->id)
                            <td>
                                {{$t->name}}
                            </td>
                            <td>
                                {{$t->type}}
                            </td>
                        @endif
                        </tr>
                    @endforeach
                    {{--<tr>

                    </tr>--}}
                @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
{{--
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
--}}

    <script>

        const vue = new Vue({
            el: '#grupos',
            data() {
                return {
                    tournaments: '',
                    from_team: []
                }
            },
            methods: {
                deleteGroup(id){
                    let c = confirm("Estas seguro que deseas eliminar este grupo?");
                    if (c){
                        document.getElementById(id).submit();
                    }
                },
                deleteItem(){
                    let toTeam = document.getElementById("to_team");
                    let fromTeam = document.getElementById("from_team");
                    this.parseOption(toTeam, fromTeam)
                },
                addItem(){
                    let toTeam = document.getElementById("to_team");
                    let fromTeam = document.getElementById("from_team");
                    this.parseOption(fromTeam, toTeam)
                },
                parseOption(selectFrom, selectTo ) {
                    let selects = [];
                    for(let i= selectFrom.options.length-1; i >= 0; i--)
                    {
                        if(selectFrom.options[i].selected) {
                            selects.push(selectFrom.options[i]);
                            selectFrom.options.remove(i);
                        }
                    }

                    for (let i=0; i<selects.length; i++) {
                        selectTo.options.add(selects[i]);
                    }
                }
            }
        })

    </script>
@endsection