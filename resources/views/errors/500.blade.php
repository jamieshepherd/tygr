@extends('_layout.base')
@section('headlinks')
<!--script src="/js/your-custom-javascript.js"></script-->
@stop
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main" class="error-status">
        @include('_layout.header')
        <div class="oh-no"><i class="fa fa-thumbs-o-down"></i></div>
        <h1>503</h1>
        <h2>Service unavailable.</h2>
        <p>Sorry, the server is currently unavailable! We'll try to keep you updated as the issue gets resolved.</p>
    </div>
</body>
@stop
