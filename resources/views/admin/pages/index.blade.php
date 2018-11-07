@extends('layouts.app')

@section('content')
    <div class="container">
        @include('layouts.notify')
        <div class="sp-title">
            <h3>Paginas</h3>
            <div>
                <a href="{{ route('page.create') }}" class="btn btn-dark btn-sm"><i class="fa fa-plus"></i></a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Titulo</th>
                <th>Descripción</th>
                <th>Url</th>
                <th>Tipo</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $p)
                <tr>
                    <td scope="row">{{ $p->title }}</td>
                    <td>{{ $p->description }}</td>
                    <td>{{ $p->url }}</td>
                    <td>{{ $p->type }}</td>
                    <td>
                        <a href="{{ route('page.edit', ['id'=> $p->id]) }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                        <form class="d-inline-block" action="{{route("page.destroy", ['id'=> $p->id])}}" method="post" id="page_{{$p->id}}">
                            {{ csrf_field() }}
                            {{ method_field("DELETE") }}
                            <button type="button" onclick="removePage('page_{{ $p->id  }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        function removePage(id){
            let c = confirm("Estas seguro que deseas eliminar esto ?");
            if (c){
                document.getElementById(id).submit();
            }
        }
    </script>
@endsection