@extends('layout.base')
@section('headlinks')
<!--script src="http://listjs.com/no-cdn/list.js"></script-->
@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<a href=""><li class="current">Clients</li></a>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>All clients</h1>
        <div id="clients">
        <input class="filter search" placeholder="Search" autofocus/>
        <a class="action" href="/clients/create"><i class="fa fa-plus-circle"></i> New client</a>

        <table class="full">
            <tr class="head">
                <th>Name</th>
                <th>Type</th>
                <th>Projects</th>
                <th>Reviewarea</th>
            </tr>
            <tbody class="list">
            @foreach($clients as $client)
            <tr onclick="document.location='/projects/{{{ $client->stub }}}';" style="cursor:pointer">
                <td class="name">{{{ $client->name }}}</td>
                <td>Client</td>
                <td><a href="/projects/{{{ $client->stub }}}">View projects</a></td>
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