@extends('layout.base')
@section('body')
    <body>
    <nav>
        <img class="sponge-logo" src="/images/sponge-logo.svg">
        <ul>
            <li><i class="fa fa-desktop"></i>Dashboard</li>
            <li><i class="fa fa-user"></i>Clients</li>
            <li><i class="fa fa-rocket"></i>Projects</li>
            <li><i class="fa fa-bug"></i>Issues</li>
        </ul>
    </nav>
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
                <li>{{ $client->name }}</li>
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