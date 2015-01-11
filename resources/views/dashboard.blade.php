@extends('layout.base')
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        <header>
            <ul class="account">
                <a href="#"><li><i class="fa fa-lock"></i> Account</li></a>
                <a href="/auth/logout"><li><i class="fa fa-sign-out"></i> Sign out</li></a>
            </ul>
        </header>
        <h1>Welcome</h1>
        <h2>List of clients</h2>
        <ul>
            @foreach ($clients as $client)
                <a href="/clients/{{{ $client->stub }}}"><li>{{ $client->name }}</li></a>
            @endforeach
        </ul>
        <h2>List of users</h2>
        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name }}</li>
            @endforeach
        </ul>
    </div>
</body>
@stop