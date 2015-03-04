@extends('_layout.base')
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        <header>
            @if(Auth::user())
                <a class="signout action nofill green" href="/auth/logout"><i class="fa fa-sign-out"></i> Sign out</a>
                <div class="crumbtrail">
                    <a href="/">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/clients">Clients</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/clients/show/{{ $client->stub }}">{{ $client->name }}</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/clients/delete/{{ $client->id }}">Confirm delete</a>
                </div>
            @endif
            <h1>Confirmation</h1>
        </header>
        <h2>Are you absolutely sure?</h2>
        <p>This will permanently delete the client <strong>{{{ $client->name }}}</strong>, it's projects and issues associated with it.</p>
        <p>Are you absolutely sure you want to delete <strong>{{{ $client->name }}}</strong>?</p><br/>

        <a class="action" href="/clients/delete/{{{ $client->id }}}?confirm=true"><i class="fa fa-exclamation-circle"></i> Yes, I'm sure</a>
        <a class="action red" href="/clients/show/{{{ $client->stub }}}"><i class="fa fa-arrow-circle-left"></i> No, take me back</a>
    </div>
@stop
