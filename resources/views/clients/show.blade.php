@extends('layout.base')
@section('headlinks')
<!--script src="http://listjs.com/no-cdn/list.js"></script-->
@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<a href="/clients"><li>Clients</li></a>
<li class="current">{{{ $client->name }}}</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>{{{ $client->name }}}</h1>
        <div id="projects">
        <input class="filter search" placeholder="Search" autofocus/>
        <a class="action" href="/clients/show/{{ $client->stub }}/create"><i class="fa fa-plus-circle"></i> New project</a>
        <a class="action" href="/clients/edit/{{ $client->id }}"><i class="fa fa-edit"></i> Edit client</a>
        <a class="action" href="/clients/delete/{{ $client->id }}"><i class="fa fa-exclamation-circle"></i> Delete client</a>
        <table class="full">
            <tr class="head">
                <th>Client</th>
                <th>Project</th>
                <th>Stub</th>
                <th>Version</th>
                <th>Project Manager</th>
            </tr>
            <tbody class="list">
            @foreach($client->projects as $project)
            <tr onclick="document.location='/projects/{{{ $project->stub }}}';" style="cursor:pointer">
                <td class="client">{{{ $client->name }}}</td>
                <td class="project">{{{ $project->name }}}</td>
                <td class="stub">{{{ $project->stub }}}</td>
                <td>{{{ $project->current_version }}}</td>
                <td>{{{ $project->project_manager }}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <script src="/js/list.js"></script>
        <script>
            var options = { valueNames: ['client','project'] };
            var userList = new List('projects', options);
        </script>
    </div>
</body>
@stop