@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <div class="sp-title">
            <h3>Crear paginas</h3>
        </div>
        <div class="container">
            <form action="{{route("page.update", ['id'=> $page->id])}}" method="post">
                {{ csrf_field() }}
                {{ method_field("PUT") }}
                <div class="form-group">
                    <label>Titulo</label>
                    <input type="text"
                           name="title"
                           value="{{ old('title', $page->title ) }}"
                           class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <input type="text"
                           value="{{ old('description', $page->description ) }}"
                           name="description"
                           class="form-control">
                </div>
                <div class="form-group">
                    <label for="type">Tipo</label>
                    <select class="form-control" name="type" id="type" required>
                        @if($page->type == 'page')
                            <option value="page" selected>Página normal</option>
                            <option value="tournament">Sección de torneo</option>
                        @elseif($page->type == 'tournament')
                            <option value="page">Página normal</option>
                            <option value="tournament" selected>Sección de torneo</option>
                        @endif
                    </select>
                </div>
                <div class="form-group" id="torneo" @if($page->type != 'tournament') style="display: none;" @endif>
                    <label for="tournament">Torneo</label>
                    <select class="form-control" name="tournament" id="tournament">
                        @foreach($tournaments as $t)
                            @if($page->parent !=0 && $page->parent == $t->id)
                                <option value="{{ $t->id }}" selected>{{$t->name}}</option>
                            @else
                                <option value="{{ $t->id }}">{{$t->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">Contenido</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control" required>{{ $page->content }}</textarea>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="Actualizar">
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="{{asset("plugins/ckeditor/ckeditor.js")}}"></script>
    <script>
        CKEDITOR.replace( 'content', {
            allowedContent: true,
            width: '100%',
            height:350
        });

        $( "#type" ).change(function() {
            if($(this).val() === "tournament"){
                $('#torneo').css("display", 'block');
            }else{
                $('#torneo').css("display", 'none');
            }
        });

    </script>
@endsection