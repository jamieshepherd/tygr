@extends('_layout.base')
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/clients"><li>Clients</li></a>
    <li class="current">Confirm delete</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>Are you absolutely sure?</h1>
        <p>This will permanently delete the issue(s): <strong>{{ $idlist }}</strong> they will not be recoverable.</p>
        <p>Are you absolutely sure you want to delete the issue(s)?</p><br/>

        <a class="action" href="{{ Request::url() }}/confirm"><i class="fa fa-exclamation-circle"></i> Yes, I'm sure</a>
        <a class="action secondary" href="/"><i class="fa fa-arrow-circle-left"></i> No, take me back</a>
    </div>
    </body>
@stop
