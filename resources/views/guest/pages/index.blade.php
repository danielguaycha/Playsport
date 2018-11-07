@extends('layouts.guest')

@section('content')
    <main class="page page-content">
        <div class="markdown-body">
            {!! $page->content !!}
        </div>
    </main>

@endsection

@section('script')
{{--    <script src="https://cdn.rawgit.com/showdownjs/showdown/1.8.7/dist/showdown.min.js"></script>
    <script>
        let converter = new showdown.Converter({ tables: true, tasklists: true, completeHTMLDocument: true }),
            text = decodeURIComponent('{{ rawurlencode($page->content) }}'),
            html = converter.makeHtml(text);
        let el = document.getElementById("markdown");
        el.innerHTML = (html);
    </script>--}}
@endsection