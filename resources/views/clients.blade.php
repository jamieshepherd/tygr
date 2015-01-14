@extends('layout.base')
@section('headlinks')
<!--script src="http://listjs.com/no-cdn/list.js"></script-->
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        <header>
            <ul class="crumbtrail">
                <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
                <a href=""><li class="current">Clients</li></a>
            </ul>
            <ul class="account">
                <a href="#"><li><i class="fa fa-lock"></i> Account</li></a>
                <a href="/auth/logout"><li><i class="fa fa-sign-out"></i> Sign out</li></a>
            </ul>
        </header>
        <h1>All clients</h1>
        <div id="clients">
        <input class="filter search" placeholder="Search" />
        <a class="action" href="/clients/create"><i class="fa fa-plus-circle"></i> New client</a>

        <table class="full">
            <tr>
                <th>Name</th>
                <th>Stub</th>
                <th>Type</th>
                <th>Projects</th>
                <th>Reviewarea</th>
            </tr>
            <tbody class="list">
            @foreach($clients as $client)
            <tr onclick="document.location='/clients/{{{ $client->stub }}}';" style="cursor:pointer">
                <td class="name">{{{ $client->name }}}</td>
                <td>{{{ $client->stub }}}</td>
                <td>Client</td>
                <td><a href="/clients/{{{ $client->stub }}}">View projects</a></td>
                <td><a href="http://reviewarea.co.uk/Secure/{{{ $client->stub }}}">Reviewarea</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <script src="/js/list.js"></script>
        <script>
            var options = { valueNames: ['name'] };
            var userList = new List('clients', options);
        </script>
    </div>
</body>
@stop