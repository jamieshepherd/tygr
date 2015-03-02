@extends('_layout.base')
@section('headlinks')
    <script src="/js/sortable.min.js"></script>
@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<a href="/clients"><li>Clients</li></a>
<li class="current">{{{ $client->name }}}</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>{{{ $client->name }}}</h1>
        <div id="projects">
        <input class="filter search" placeholder="Search" autofocus/>
        <a class="action" href="/clients/show/{{ $client->stub }}/create"><i class="fa fa-plus-circle"></i> New project</a>
        <a class="action" href="/clients/edit/{{ $client->id }}"><i class="fa fa-edit"></i> Edit client</a>
        @if(Auth::user()->rank == 1)
        <a class="action" href="/clients/delete/{{ $client->id }}"><i class="fa fa-exclamation-circle"></i> Delete client</a>
        @endif
            @if(count($client->projects) > 0)
                <table class="full" data-sortable>
                    <thead>
                    <tr class="head">
                        <th>Client <i class="fa fa-sort"></i></th>
                        <th>Project <i class="fa fa-sort"></i></th>
                        <th>Stub <i class="fa fa-sort"></i></th>
                        <th>Issues <i class="fa fa-sort"></i></th>
                        <th>Version <i class="fa fa-sort"></i></th>
                        <th>Project Manager <i class="fa fa-sort"></i></th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach($client->projects as $project)
                        <tr onclick="document.location='/projects/{{ $project->client->stub }}/{{{ $project->stub }}}';" style="cursor:pointer">
                            <td class="client">{{{ $client->name }}}</td>
                            <td class="project">{{{ $project->name }}}</td>
                            <td class="stub">{{{ $project->stub }}}</td>
                            <td class="issues">{{{ count($project->issues) }}}</td>
                            <td>{{{ $project->current_version }}}</td>
                            <td class="project_manager">{{{ $project->project_manager }}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <h2>No projects found</h2>
                <p><i class="fa fa-info-circle"></i> There are no projects associated with this client, would you like to <a href="{{ Request::url() }}/create">create one</a>?</p>
            @endif
        </div>
        <script src="/js/list.js"></script>
        <script>
            var options = { valueNames: ['client','project'] };
            var userList = new List('projects', options);
        </script>
    </div>
@stop
