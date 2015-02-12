@extends('_layout.base')
@section('headlinks')

@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<a href=""><li class="current">Help</li></a>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>Help</h1>
        <p>A list of frequently asked questions to help you use the system.</p>
    </div>
</body>
@stop
