@extends('layout.base')
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
        <input type="text" class="filter" placeholder="Filter clients">
        <a class="action" href=""><i class="fa fa-users"></i> Client name</a>
        <table class="full">
            <tr>
                <th>Name</th>
                <th>Stub</th>
                <th>Type</th>
                <th>Projects</th>
                <th>Reviewarea</th>
            </tr>
            @foreach($clients as $client)
            <tr onclick="document.location='/clients/{{{ $client->stub }}}/projects';" style="cursor:pointer">
                <td>{{{ $client->name }}}</td>
                <td>{{{ $client->stub }}}</td>
                <td>Client</td>
                <td><a href="/clients/{{{ $client->stub }}}">View projects</a></td>
                <td><a href="http://reviewarea.co.uk/Secure/{{{ $client->stub }}}">Reviewarea</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
@stop