@extends('layouts.app')

@section('content')
    <div class="container" id="stage">
        @include('layouts.notify')
        <div class="sp-title">
            <h3>Eliminatoria</h3>
        </div>
        @if(!request()->get('tournament'))
            <form method="get">
                <div class="form-group">
                    <label for="">Seleccione el torneo para Elminatoria</label>
                    <select class="form-control" name="tournament">
                        @foreach($tournaments as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Numero de encuentros</label>
                    <input type="number"
                           class="form-control"
                           max="8"
                           v-model="n"
                           min="1"
                           required
                           name="n" placeholder="Ingrese el numero de encuentros" value="{{ old("n") }}">
                    <small id="helpId" class="form-text text-muted">Para una eliminatoria es necesario definir encuentros de dos equipos!</small>
                </div>
                <div class="form-group">
                    <input type="submit" value="Siguiente" class="btn btn-success">
                </div>
            </form>
        @else
            {{--Info torneo--}}
            <div class="d-flex justify-content-between">
                <h5>Torneo: <span class="text-info">{{ $tournaments->name }}</span></h5>
                <h5>Tipo: <span class="text-info">{{ $tournaments->type }}</span></h5>
                <h5>Deporte: <span class="text-info">{{ $sport->name }}</span></h5>
            </div>

            <form action="{{route('stage.store')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" value="{{$tournaments->id}}" name="tournament_id" required>
                <input type="hidden" value="{{request()->get('n')}}" name="match_num">
                @if(count($stages)>0)
                    <div class="form-group">
                        <label for="">Seleccione padre predecesor</label>
                        <select class="form-control" name="parent" id="parent">
                            <option value="0">Ninguno</option>
                            @foreach($stages as $st)
                                <option value="{{$st->id}}">{{$st->name}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text"
                           required
                           maxlength="100"
                           class="form-control" name="name" id="name" placeholder="Ingrese nombre para esta etapa">
                </div>

                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-info" type="submit">Guardar</button>
                </div>
            </form>

           {{-- <form action="" id="form-stages">
                <input type="hidden" name="team_vs" id="team_vs">
                <hr>
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" name="name"  placeholder="Nombre de la eliminatoria">
                </div>
                <br>

                <h5>Enfrentamientos</h5>
                <div class="form-group row vs-container">
                    <div class="pt-2 pb-2 col-md-12" v-if="message">
                        <div  class="alert alert-warning" role="alert">
                            <strong>@{{message}}</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Seleccione</label>
                            <select multiple class="custom-select" @click="selected()"
                                    id="teams_selected" style="height: 15rem">
                                <option disabled>Selecciones de dos en dos</option>
                                @foreach($teams as $t)
                                    <option value="{{$t->id}}">{{$t->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="sp-arrows">
                            <button class="btn btn-success" @click.prevent="parseTeams">
                                <i class="fa fa-long-arrow-alt-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <h5>Encuentros</h5>
                        <div class="vs">

                        </div>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <div class="form-group text-center">
                            <input type="button" value="Guardar" class="btn btn-success" @click.prevent="sendForm()">
                        </div>
                    </div>
                </div>
            </form>--}}
        @endif
    </div>
@endsection

@section('style')

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
           el: '#stage',
            data(){
               return {
                    team_a: "",
                    team_b: "",
                    message: "",
                    n: 0
               }
            },
            mounted(){

            },
            methods: {
               selected(){
                    this.message='';
                    let el = document.getElementById("teams_selected");
                    if(el.selectedOptions.length >=3){
                        for (let i = 0, l = el.length; i < l; i++) {
                            el[i].selected = el[i].defaultSelected;
                        }
                        this.message ="Solo puedes seleccionar de dos en dos";
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
                    let vss = '';
                    for(let i=0; i<sl.length; i++){
                        if (i===(sl.length-1))
                            vss+=sl[i].options[0].value+";"+sl[i].options[1].value;
                        else
                            vss+=sl[i].options[0].value+";"+sl[i].options[1].value+"|";
                    }
                    if(vss.split("|").length%2!==0){
                        this.message ="No se permite una eliminatoria con encuentros impares";
                        return;
                    }

                    document.getElementById("team_vs").value = vss;
                    document.getElementById("form-stages").submit();
               },
            }
        });
    </script>


@endsection