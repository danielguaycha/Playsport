@extends('layouts.guest')

@section('content')
    <main class="content-max vh100">
    @include('guest.torneo.partials._futbol', [$tournament, $pages])


    {!! $content->content !!}


    </main>
@endsection
{{--

<div class="page-content" style="border: none">
  </div>--}}
