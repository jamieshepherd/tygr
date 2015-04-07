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
                    <a href="{{ Request::url() }}">503</a>
                </div>
            @endif
        </header>
        <div class="oh-no"><i class="fa fa-thumbs-o-down"></i></div>
        <h1>503</h1>
        <h2>Service unavailable.</h2>
        <p>Sorry, the server is currently unavailable! We'll try to keep you updated as the issue gets resolved.</p>
    </div>
@stop
