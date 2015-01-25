@extends('layout.base')
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<li class="current">Projects</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>Projects</h1>
            @if(count($client->projects)==0)
                <p>Sorry, there are no projects listed for this client yet.</p>
            @endif
            @foreach ($client->projects as $project)
                @if($project->public || $client->id == 1)
                <div class="project-preview">
                    <h3>{{ $project->name }}</h3>
                    <ul>
                        <li><strong>Project manager: </strong>Andrea Kinsman</li>
                        <li><strong>Project status: </strong>In development</li>
                        <li><strong>Current version: </strong>2.0</li>
                        <li><strong>View project: </strong><a href="/projects/{{{ $project->stub }}}">Click here</a></li>
                    </ul>
                </div>
                @endif
            @endforeach
    </div>
</body>
@stop