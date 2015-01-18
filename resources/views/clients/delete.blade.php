@extends('layout.base')
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/clients"><li>Clients</li></a>
    <li class="current">Confirm delete</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>Are you absolutely sure?</h1>
        <p>This will permanently delete the client <strong>{{{ $client->name }}}</strong>, it's projects and issues associated with it.</p>
        <p>Are you absolutely sure you want to delete <strong>{{{ $client->name }}}</strong>?</p><br/>
        <a class="action" href="/clients/delete/{{{ $client->id }}}/confirm"><i class="fa fa-exclamation-circle"></i> Yes, I'm sure</a>
        <a class="action secondary" href="/clients/show/{{{ $client->stub }}}"><i class="fa fa-arrow-circle-left"></i> No, take me back</a>
    </div>
    </body>
@stop