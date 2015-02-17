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
        <h1>403</h1>
        <h2>Forbidden.</h2>
        <p>Oops, it looks like you've tried to go somewhere you aren't supposed to! Nevermind, use the navigation to the left and we'll get you back on the right path.</p>
    </div>
    </body>
@stop
