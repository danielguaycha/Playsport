@extends('layouts.app')

@section('content')
    <div class="container" id="container">
        <div class="sp-title">
            <h5>Generador de Fechas</h5>
            <div>
                <a class="btn btn-info btn-sm" href="{{ route('tournament.show', ['id'=> $tournament_id]) }}"><i class="fa fa-arrow-left"></i> Regresar al Torneo</a>
                <button onclick=" location.reload(); " class="btn btn-danger btn-sm"><i class="fa fa-sync"></i></button>
                <button class="btn btn-dark btn-sm ml-2 btn-save"><i class="fa fa-save"></i> Guardar</button>
            </div>
        </div>
        <div>
            <p><b>Hola!</b> Notamos que vas a crear una liguilla, hemos generado las fechas por ti! Completa los datos y presiona el botón guardar</p>
        </div>
        <form action="">


        <div class="form-group">
            <label for="">Nombre de la Liguilla</label>
            <input type="text" class="form-control" name="name" id="name"
                   placeholder="Ingrese un nombre">
        </div>
        @php $i=1; @endphp
        @foreach($dates as $round)
            <div class="card">
                <h5 class="card-header">Ronda # {{ $i }}</h5>
                <div class="card-body table-responsive">
                    <table class="table">
                        <tbody class="round" id="round-{{ $i }}">
                        @foreach($round as $vs)
                            @if(isset($vs['a'][2]) and isset($vs['b'][2]))
                            <tr class="vs">
                                <td scope="row">
                                    @if(isset($vs['a'][2]))
                                        <img class="rounded-circle" src="{{ asset($vs['a'][2]) }}" width="30px">
                                        {{ $vs['a'][1] }}
                                        <input type="hidden" data-id="team_a" value="{{ $vs['a'][0] }}">
                                    @endif
                                </td>
                                <td scope="row">
                                    @if(isset($vs['b'][2]))
                                        <img class="rounded-circle" src="{{ asset($vs['b'][2]) }}" width="30px">
                                        {{ $vs['b'][1] }}
                                        <input type="hidden" data-id="team_b" value="{{ $vs['b'][0] }}">
                                    @endif
                                </td>
                                <td width="35%">
                                    <div class="d-flex">
                                        <input type="date" data-id="date" class="form-control" placeholder="Fecha">
                                        <input type="time" data-id="time" class="form-control" placeholder="Hora">
                                    </div>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        @foreach($round as $vs)
                            @if(! isset($vs['a'][2]) || !isset($vs['b'][2]))
                                @if(isset($vs['a'][1]))
                                    <tr class="text-center vs">
                                        <td colspan="4">
                                            <img class="rounded-circle" src="{{ asset($vs['a'][2]) }}" width="30px">
                                            {{ $vs['a'][1] }}<b> Libre</b>
                                            <input type="hidden" data-id="team_a" value="{{ $vs['a'][0] }}">
                                            <input type="hidden" data-id="team_b" value="0">
                                        </td>
                                    </tr>
                                @elseif(isset($vs['b'][1]))
                                    <tr class="text-center vs">
                                        <td colspan="4">
                                            <img class="rounded-circle" src="{{ asset($vs['b'][2]) }}" width="30px">
                                            {{ $vs['b'][1] }}<b> Libre</b>
                                            <input type="hidden" data-id="team_b" value="{{ $vs['b'][0] }}">
                                            <input type="hidden" data-id="team_a" value="0">
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @php $i++; @endphp
        @endforeach

        </form>
        {{--<div class="row">
            <div class="col-md-12">
                <button id="btnSave" class="btn btn-primary"><i class="fa-fa-image"></i>Generar</button>
                <div class="canvas"></div>
            </div>
        </div>--}}
        @include('admin.tournament._back', ['tournament_id'=>$tournament_id ])
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/html2canvas.js') }}"></script>
    <script>

        $(function() {
            $("#btnSave").click(function() {
                html2canvas($("#container"), {
                    onrendered: function(canvas) {
                        let getCanvas = canvas;

                        document.querySelector('.canvas').appendChild(canvas);
                        download(canvas, "file.png")
                    }
                });
            });
        });

        function download(canvas, filename) {
            /// create an "off-screen" anchor tag
            let lnk = document.createElement('a'), e;

            /// the key here is to set the download attribute of the a tag
            lnk.download = filename;

            /// convert canvas content to data-uri for link. When download
            /// attribute is set the content pointed to by link will be
            /// pushed as "download" in HTML5 capable browsers
            lnk.href = canvas.toDataURL("image/png;base64");

            /// create a "fake" click-event to trigger the download
            if (document.createEvent) {
                e = document.createEvent("MouseEvents");
                e.initMouseEvent("click", true, true, window,
                    0, 0, 0, 0, 0, false, false, false,
                    false, 0, null);

                lnk.dispatchEvent(e);
            } else if (lnk.fireEvent) {
                lnk.fireEvent("onclick");
            }
        }


        $('.btn-save').click(function () {

            // obtención de metadata
            let nameLigue = $('#name').val();
            if(nameLigue==='' || nameLigue===null){
                alert('Ingresa un nombre para la Liga');
                return;
            }

            // obtención de las rondas
            let data = [];
            $('.round').each(function (i) {
                let vs = [];
                $(this).find('.vs').each(function (j) {
                    let timeTable = {};
                    timeTable['ronda'] = i+1;
                    $(this).find('input').each(function (k) {
                        timeTable[$(this).data('id')] = $(this).val();
                    });
                    //console.log(JSON.stringify(timeTable));
                    vs.push(timeTable);
                });
                console.log(JSON.stringify(vs));
                data.push(vs);
            });
            // guardado de datos
            let url = '/api/league/store';
            fetch(url, {
                method: 'POST', // or 'PUT'
                body: JSON.stringify({
                    name: nameLigue,
                    dates: data,
                    'id': '{{ $tournament_id }}',
                }),
                headers:{
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json())
                .catch(error => console.error('Error:', error))
                .then(response =>{
                    location.href = '{{ url(route('tournament.show', ['id'=> $tournament_id])) }}';
                });
        })

    </script>
@endsection