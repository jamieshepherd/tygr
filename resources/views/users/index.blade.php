@extends('_layout.base')
@section('headlinks')
    <script src="/js/list.min.js"></script>
    <script src="/js/sortable.min.js"></script>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main"><header>
            @if(Auth::user())
                <a class="signout action nofill green" href="/auth/logout"><i class="fa fa-sign-out"></i> Sign out</a>
                <div class="crumbtrail">
                    <a href="/">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/users">Users</a>
                </div>
            @endif
            <h1>All users</h1>
        </header>
        <div id="users">
        <input class="filter search" placeholder="Search" autofocus/>
        <a class="action" href="/users/create"><i class="fa fa-plus-circle"></i> New user</a>

        <table class="full" data-sortable>
            <thead>
                <tr class="head">
                    <th>Name <i class="fa fa-sort"></i></th>
                    <th>Email <i class="fa fa-sort"></i></th>
                    <th>Rank <i class="fa fa-sort"></i></th>
                    <th>Client <i class="fa fa-sort"></i></th>
                </tr>
            </thead>
            <tbody class="list">
            @foreach($users as $user)
            <tr onclick="document.location='/users/show/{{{ $user->id }}}';" style="cursor:pointer">
                <td class="name">{{ $user->name }}</td>
                <td class="email">{{ $user->email }}</td>
                <td class="rank">@if($user->rank == 1) Admin @elseif($user->rank == 2) Employee @else Client @endif</td>
                <td class="user_client">{{{ $user->client->name }}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <script>
            var options = { valueNames: ['name','email','user_client'] };
            var userList = new List('users', options);
        </script>
    </div>
@stop
