@extends('_layout.base')
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main" class="error-status">
        <header>
            @if(Auth::user())
                <a class="signout action nofill green" href="/auth/logout"><i class="fa fa-sign-out"></i> Sign out</a>
                <div class="crumbtrail">
                    <a href="/">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="{{ Request::url() }}">401</a>
                </div>
            @endif
        </header>
        <div class="oh-no"><i class="fa fa-thumbs-o-down"></i></div>
        <h1>401</h1>
        <h2>Unauthorised.</h2>
        <p>Oops, it looks like you've tried to go somewhere you aren't supposed to! Nevermind, use the navigation to the left and we'll get you back on the right path.</p>
    </div>
@stop
