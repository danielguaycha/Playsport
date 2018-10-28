@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de Administración</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <b class="text-info">Bienvenido</b>

                        <br><br>
                        <div>
                            <a href="{{route('tournament.index')}}" class="page-link text-dark">1. Crea Torneo</a>
                            <a href="{{ route('team.index') }}" class="page-link text-dark" >2. Crea Equipos y Jugadores</a>
                            <a href="" class="page-link text-dark">3. Crea Grupos o Crea Eliminatoria</a>
                            <a href="" class="page-link text-dark">4. Define fechas</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
