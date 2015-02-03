@extends('_layout.base')
@section('headlinks')
<!--script src="/js/your-custom-javascript.js"></script-->
@stop
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <li>503: Service unavailable</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>503</h1>
        <p>Service unavailable.</p>
    </div>
</body>
@stop
