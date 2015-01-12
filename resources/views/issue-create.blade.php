@extends('layout.base')
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        <header>
            <ul class="crumbtrail">
                <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
                <a href="/clients/{{{ $client->stub }}}"><li>{{{ $client->name }}}</li></a>
                <a href="/clients/{{{ $client->stub }}}/projects/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
                <a href="/clients/{{{ $client->stub }}}/projects/{{{ $project->stub }}}/issues"><li>Issues</li></a>
                <li class="current">Create</li>
            </ul>
            <ul class="account">
                <a href="#"><li><i class="fa fa-lock"></i> Account</li></a>
                <a href="/auth/logout"><li><i class="fa fa-sign-out"></i> Sign out</li></a>
            </ul>
        </header>
        <h1>Log an issue</h1>
        {!! Form::open(array('url' => Request::url(), 'action' => 'IssueController@store')) !!}
        {!! Form::label('email', 'E-Mail Address') !!}
        {!! Form::text('email') !!}
        {!! Form::close() !!}

    </div>
    </body>
@stop
