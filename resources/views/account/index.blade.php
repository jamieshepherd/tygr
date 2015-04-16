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
                    <a href="/account">Account</a>
                </div>
            @endif
            <h1>Account</h1>
        </header>
        <a class="action yellow" href="/account/edit"><i class="fa fa-edit"></i> Edit details</a>
        <a class="action yellow" href="/account/edit"><i class="fa fa-lock"></i> Change password</a>
        <h2>Full name</h2>
        <p>{{ Auth::user()->name }}</p>
        <h2>Email address</h2>
        <p>{{ Auth::user()->email }}</p>
        <h2>Organisation</h2>
        <p>{{ Auth::user()->client->name }}</p>
        @if(Auth::user()->rank != 3)
            <h2>Groups</h2>
            <ul class="standard">
            @foreach(Auth::user()->groups()->get() as $group)
                <li>{{{ $group->name }}}</li>
            @endforeach
            </ul>
        @endif
    </div>
@stop
