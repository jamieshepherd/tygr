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
                    <a href="{{ Request::url() }}">404</a>
                </div>
            @endif
        </header>
        <div class="oh-no"><i class="fa fa-thumbs-o-down"></i></div>
        <h1>404</h1>
        <h2>Page not found.</h2>
        <p>Sorry, we couldn't find that page. If it's a dead link, <a href="mailto:email@jamie.sh">we'd like to know</a>. Otherwise, you can use the navigation to the left to find what you were looking for.</p>
    </div>
@stop
