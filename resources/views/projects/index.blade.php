@extends('_layout.base')
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        <header>
            @if(Auth::user())
                <a class="signout action nofill green" href="/auth/logout"><i class="fa fa-sign-out"></i> Sign out</a>
                <div class="crumbtrail">
                    <a href="/">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/projects">Projects</a>
                </div>
            @endif
            <h1>Projects</h1>
        </header>
            @if(count($projects)==0)
                <p>Sorry, there are no projects listed for this client yet.</p>
            @endif
            <div class="projects-index">
            @foreach ($projects as $project)
                @if(!$project->hidden || $client->id == 1)
                <div class="col">
                <a href="/projects/{{ $project->client->stub }}/{{ $project->stub }}" class="project-preview">
                    <h3>{{ $project->name }}</h3>
                    <hr/>
                    <ul>
                        <li><strong>Status:</strong> {{ $project->status }}</li>
                        <li><strong>Issues:</strong> {{ count($project->issues) }}</li>
                    </ul>
                    <div class="project-progress">
                        @if($project->status == 'Complete')
                            <div class="percent percent-100"></div>
                        @elseif($project->status == 'Amends')
                            <div class="percent percent-75"></div>
                        @elseif($project->status == 'In development')
                            <div class="percent percent-50"></div>
                        @elseif($project->status == 'Storyboard')
                            <div class="percent percent-25"></div>
                        @elseif($project->status == 'Kickoff')
                            <div class="percent percent-5"></div>
                        @endif
                    </div>
                </a>
                </div>
                @endif
            @endforeach
            </div>
    </div>
@stop
