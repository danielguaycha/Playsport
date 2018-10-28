@extends('layouts.app')

@section('content')

    <div class="container">
        @include('layouts.notify')
        <div class="sp-title">
           <h3>Equipos</h3>
           <div>
               <form class="form-inline m-xl-4">
                   <div class="form-group">
                       <div class="form-group">
                           <select class="form-control-sm" name="sport" >
                               <option selected value="">Todos los deportes...</option>
                              @foreach($sports as $s)
                                  @if(request()->query("sport"))
                                        @if(request()->query('sport') == $s->id)
                                           <option selected value="{{ $s->id }}">{{ $s->name }}</option>
                                        @else
                                           <option value="{{ $s->id }}">{{ $s->name }}</option>
                                        @endif
                                  @else
                                       <option value="{{ $s->id }}">{{ $s->name }}</option>
                                  @endif
                              @endforeach
                           </select>
                       </div>
                       <div class="form-group">
                           <select class="form-control-sm" name="type">
                               <option selected value="">Todos los generos</option>
                               <option value="Male">Masculino</option>
                               <option value="Female">Femenino</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <input type="submit" value="Filtrar" class="btn btn-sm btn-info">
                       </div>
                   </div>
               </form>
               <a href="{{route("team.create")}}" class="btn btn-dark btn-sm"><i class="fa fa-plus"></i></a>
           </div>
        </div>
        <div class="table-responsive">
            <table class="table table-sm table-hover ">
           <thead>
               <tr>
                   <th scope="col" width="10%">#</th>
                   <th scope="col" class="d-none d-md-block">Logo</th>
                   <th scope="col">Género</th>
                   <th scope="col" width="30%">Nombre</th>
                   <th>Deporte</th>
                   <th scope="col">Jugadores</th>
                   <th scope="col" width="15%">Opciones</th>
               </tr>
           </thead>
            <tbody>
            @foreach($Team as $team)

                <tr>
                    <td> {{$team -> id}} </td>
                    <td class="d-none d-md-block">
                        <img src="{{asset('img/logo.png')}}" alt="logo" width="30px">
                    </td>
                    <td> {{$team -> type}} </td>
                    <td> {{$team -> name}} </td>
                    <td>
                        @foreach($sports as $s)
                            @if($s->id == $team->sport_id)
                                {{ $s->name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <b class="text-dark">{{ $team->players }}</b>&nbsp;|
                        <a href="{{ route("player.create", ['t'=> $team-> id] ) }}"
                           class="btn btn-sm btn-outline-primary"><i class="fa fa-plus"></i></a>
                        <a href="{{route('team.show', ['id'=> $team->id])}}"
                           title="Ver jugadores"
                           class="btn btn-outline-primary btn-sm"><i class="fa fa-eye"></i></a>
                    </td>
                    <td>
                        <form id="team_{{ $team->id }}" class="d-inline-block" action="{{route('team.destroy', ['id'=> $team->id])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="button" class="btn btn-sm btn-danger" onclick="removeTeam('team_{{ $team->id }}')"><i class="fa fa-trash"></i></button>
                        </form>
                        <a href="{{route("team.edit", ["id"=> $team-> id])}}" class="btn btn-sm btn-info"><i class="fa fa-pen"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
       </table>
        </div>
   </div>
@endsection

@section('script')
    <script>
        function removeTeam(id){
            let c = confirm("Deseas eliminar este Equipo?");
            if (c){
                document.getElementById(id).submit();
            }
        }
    </script>
@endsection