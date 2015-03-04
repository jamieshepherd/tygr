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
                    <i class="fa fa-angle-right"></i>
                    <a href="/projects/{{ $project->client->stub }}/{{ $project->stub }}">{{ $project->name }}</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/projects/{{ $project->client->stub }}/{{ $project->stub }}/issues">Issues</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="{{ Request::url() }}">Confirm delete</a>
                </div>
            @endif
            <h1>Confirmation</h1>
        </header>
        <h2>Are you absolutely sure?</h2>
        <p>This will permanently delete the issue(s): <strong>{{ $idlist }}</strong> they will not be recoverable.</p>
        <p>Are you absolutely sure you want to delete the issue(s)?</p><br/>

        <a class="action" href="{{ Request::url() }}?confirm=true"><i class="fa fa-exclamation-circle"></i> Yes, I'm sure</a>
        <a class="action red" href="/"><i class="fa fa-arrow-circle-left"></i> No, take me back</a>
    </div>
@stop
