@extends('layout.base')
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<a href="/projects"><li>Projects</li></a>
<li class="current">{{{ $project->name }}}</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>{{{ $project->name }}}</h1>
        <a class="action" href="{{ Request::url() }}/issues/create"><i class="fa fa-plus-circle"></i> Log an issue</a>
        @if(Auth::user()->rank <= 2)
            <a class="action" href="{{ Request::url() }}/edit"><i class="fa fa-edit"></i> Edit project</a>
        @endif
        <a class="action" href="{{ Request::url() }}/issues"><i class="fa fa-bug"></i> View issues</a>
        <a class="action" href="{{ Request::url() }}/review/"><i class="fa fa-desktop"></i> Review area</a>
        <div class="info-box">
            <table>
                <tr><td><strong>Current version</strong></td><td>{{{ $project->current_version }}}</td></tr>
            </table>
            <hr/>
            <table>
                <tr><td><strong>Project manager</strong></td><td>{{{ $project->project_manager }}}</td></tr>
                <tr><td><strong>Lead developer</strong></td><td>{{{ $project->lead_developer }}}</td></tr>
                <tr><td><strong>Lead designer</strong></td><td>{{{ $project->lead_designer }}}</td></tr>
                <tr><td><strong>Instructional designer</strong></td><td>{{{ $project->instructional_designer }}}</td></tr>

            </table>
            <hr/>
            <table>
                <tr><td><strong>Authoring tool</strong></td><td>{{{ $project->authoring_tool }}}</td></tr>
                <tr><td><strong>LMS Deployment</strong></td><td>{{{ $project->lms_deployment }}}</td></tr>
                <tr><td><strong>Specification</strong></td><td>{{{ $project->lms_specification }}}</td></tr>
            </table>
        </div>
        <h2>You have 0 issues assigned to you!</h2>
        <p>You're up to date, and you have no issues assigned to you.</p>
    </div>
</body>
@stop