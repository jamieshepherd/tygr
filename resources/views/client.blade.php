@extends('layout.base')
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        <header>
            <ul class="crumbtrail">
                <li><i class="fa fa-home"></i> Home</li>
                <li class="current">{{ $client->name }}</li>
            </ul>
            <ul class="account">
                <a href="#"><li><i class="fa fa-lock"></i> Account</li></a>
                <a href="/auth/logout"><li><i class="fa fa-sign-out"></i> Sign out</li></a>
            </ul>
        </header>
        <h1>{{ $client->name }}</h1>
        <h2>Quick list of modules</h2>
        <ul>

        </ul>
    </div>
</body>
@stop