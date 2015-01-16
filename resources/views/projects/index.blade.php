@extends('layout.base')
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        <header>
            <ul class="crumbtrail">
                <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
                <a href="#"><li class="current">{{ $client->name }}</li></a>
            </ul>
            <ul class="account">
                <a href="#"><li><i class="fa fa-lock"></i> Account</li></a>
                <a href="/auth/logout"><li><i class="fa fa-sign-out"></i> Sign out</li></a>
            </ul>
        </header>
        <h1>{{ $client->name }}</h1>
        <h2><i class="fa fa-rocket"></i> Projects</h2>
            @foreach ($projects as $project)
                <div class="project-preview">
                    <h3>{{ $project->name }}</h3>
                    <ul>
                        <li><strong>Project manager: </strong>Andrea Kinsman</li>
                        <li><strong>Project status: </strong>In development</li>
                        <li><strong>Current version: </strong>2.0</li>
                        <li><strong>View project: </strong><a href="/clients/{{{ $client->stub }}}/projects/{{{ $project->stub }}}">Click here</a></li>
                    </ul>
                </div>
            @endforeach
    </div>
</body>
@stop