<div class="row">
    <div class="col-md-12">
    @if (session()->has('warning'))
        <div class="alert alert-warning" role="alert">
            <b>{{ session()->get('warning') }}</b>
        </div>
    @elseif(session()->has('success'))
        <div class="alert alert-success" role="alert">
            <b>{{ session()->get('success') }}</b>
        </div>
    @elseif (session()->has('info'))
        <div class="alert alert-info" role="alert">
            <b>{{ session()->get('info') }}</b>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
</div>