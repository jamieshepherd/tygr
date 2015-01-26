@extends('_layout.base')
@section('headlinks')
<script src="/js/list.min.js"></script>
@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<a href=""><li class="current">Users</li></a>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>All users</h1>
        <div id="users">
        <input class="filter search" placeholder="Search" autofocus/>
        <a class="action" href="/users/create"><i class="fa fa-plus-circle"></i> New user</a>

        <table class="full">
            <tr class="head">
                <th>Name</th>
                <th>Email</th>
                <th>Client</th>
            </tr>
            <tbody class="list">
            @foreach($users as $user)
            <tr onclick="document.location='/users/show/{{{ $user->id }}}';" style="cursor:pointer">
                <td class="name">{{{ $user->name }}}</td>
                <td class="email">{{{ $user->email }}}</td>
                <td class="client">{{{ $user->client->name }}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <script>
            var options = { valueNames: ['name','email','client'] };
            var userList = new List('users', options);
        </script>
    </div>
</body>
@stop
