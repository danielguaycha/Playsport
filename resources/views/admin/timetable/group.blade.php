@extends('layouts.app')

@section('content')

    <div class="container" id="group">
        @include('layouts.notify')
        <div class="sp-title">
            <h3>Crear enfrentamientos para grupo "{{ $group->name }}"</h3>
        </div>
        <hr>
        <form action="{{route('timetable.store')}}" method="post" id="form-groups">
            <input type="hidden" name="type" value="group">
            <input type="hidden" name="teams" id="team_vs">
            <input type="hidden" name="group" value="{{$group->id}}">
            {{csrf_field()}}
            <div class="form-group row">
                <div class="pt-2 pb-2 col-md-12" v-if="message">
                    <div  class="alert alert-warning" role="alert">
                        <strong>@{{message}}</strong>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label>Lugar</label>
                    <input type="text"
                           v-model="place"
                           class="form-control" name="place" required maxlength="50">
                </div>
                <div class="col-md-4">
                    <label>Hora</label>
                    <input type="time"
                           v-model="time"
                           class="form-control" name="hour" required>
                </div>
                <div class="col-md-4">
                    <label>Fecha</label>
                    <input type="date"
                           v-model="date"
                           class="form-control" name="date" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Seleccione</label>
                        <select multiple class="custom-select" @click="selected()"
                                id="teams_selected" style="height: 10rem">
                            <option disabled>Selecciones de dos en dos</option>
                            @foreach($teams as $t)
                                <option value="{{$t->id}}">{{$t->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="sp-arrows">
                        <button class="btn btn-info" @click.prevent="parseTeams">
                            <i class="fa fa-long-arrow-alt-right"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-5">
                    <label>Encuentro</label>
                    <div class="vs">

                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <hr>
                <button type="button" class="btn btn-info" @click.prevent="sendForm()">Guardar</button>
            </div>
        </form>
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
    </div>

@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script>
        document.querySelector("html").addEventListener("click", (e)=>{
            if(e.srcElement.classList.contains("btn-remove")){
                let selectFrom = e.srcElement.parentElement;
                let target=document.getElementById("teams_selected");

                let selects = [];
                for(let i= selectFrom.options.length-1; i >= 0; i--)
                {
                    if (!selectFrom.options[i].classList.contains("btn-remove")) {
                        selectFrom.options[i].removeAttribute("disabled");
                        selects.push(selectFrom.options[i]);
                        selectFrom.options.remove(i);
                    }
                }

                for (let i=0; i<selects.length; i++) {
                    target.options.add(selects[i]);
                }
                e.srcElement.parentElement.remove();
            }
        });
        const vue = new Vue({
            el: '#group',
            data(){
                return {
                    message: "",
                    n: 0,
                    place: '{{ 'Machala' }}',
                    time: '{{ '08:00' }}',
                    date: '2018-11-15'
                }
            },
            methods: {
                delTimeTable(id){
                    let c = confirm("Seguro deseeas elminar esta fecha?");
                    if (c){
                        document.getElementById(id).submit();
                    }
                },
                selected(){
                    this.message='';
                    let el = document.getElementById("teams_selected");
                    if(el.selectedOptions.length >2){
                        for (let i = 0, l = el.length; i < l; i++) {
                            el[i].selected = el[i].defaultSelected;
                        }
                        this.message ="Solo puedes seleccionar dos equipos";
                    }
                },
                parseTeams(){
                    let selectFrom=document.getElementById("teams_selected");
                    if (selectFrom.selectedOptions.length<=1){
                        this.message ="Selecciona minimo 2";
                        return;
                    }
                    let selects = [];
                    for(let i= selectFrom.options.length-1; i >= 0; i--) {
                        if(selectFrom.options[i].selected) {
                            selects.push(selectFrom.options[i]);
                            selectFrom.options.remove(i);
                        }
                    }

                    let el = document.createElement("select");
                    el.setAttribute("class", "form-control selectedTeam");
                    el.setAttribute("multiple", "mulitple");
                    el.setAttribute("id", selects[0].value);

                    el.style.marginBottom = "10px";
                    el.style.height = "6rem";
                    el.style.border= "1px solid #17a2b8;";
                    el.style.overflow ="hidden";
                    el.innerHTML = '<option disabled value="'+selects[0].value+'">'+selects[0].text+'</option>' +
                        '<option disabled value="'+selects[1].value+'">'+selects[1].text+'</option>' +
                        '<option class="btn-remove btn btn-danger d-block bg-danger text-white" style="margin: 0 auto; width: 10%"><b>X</b></option>';

                    let container = document.querySelector(".vs");
                    container.appendChild(el)
                },
                sendForm(){
                    let sl = document.getElementsByClassName("selectedTeam");

                    if (!this.place || !this.time || !this.date){
                        this.message = 'El lugar, hora y fecha son requeridos';
                        return;
                    }

                    if (sl.length<=0){
                        this.message='No has seleccionado los equipos';
                        return;
                    }

                    let vss = '';
                    for(let i=0; i<sl.length; i++){
                        if (i===(sl.length-1))
                            vss+=sl[i].options[0].value+";"+sl[i].options[1].value;
                        else
                            vss+=sl[i].options[0].value+";"+sl[i].options[1].value+"|";
                    }
                    document.getElementById("team_vs").value = vss;
                    document.getElementById("form-groups").submit();
                },
            }
        });
    </script>


@endsection