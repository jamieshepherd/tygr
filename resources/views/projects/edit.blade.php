@extends('layout.base')
@section('headlinks')
    <script src="/js/helpers.js"></script>
@stop
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/clients"><li>Clients</li></a>
    <a href="/projects/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
    <li class="current">Edit</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>Edit <em>{{{ $project->name }}}</em></h1>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label>Project name</label>
            <input id="name" name="name" type="text" placeholder="e.g. Fire Safety" value="{{{ $project->name }}}" onkeyup="generateStub()">

            <label>Project stub<em>(Used for URLs)</em></label>
            <input id="stub" name="stub" type="text" placeholder="e.g. firesafety" value="{{{ $project->stub }}}">

            <label>Current version</label>
            <input name="current_version" type="text" placeholder="e.g. Version 1" value="{{{ $project->current_version }}}">

            <label>Project status</label>
            <input name="status" type="text" placeholder="e.g. In development, Launched" value="{{{ $project->status }}}">

            <hr/>

            <label>Authoring Tool</label>
            <input name="authoring_tool" type="text" placeholder="e.g. Adapt, Storyline, Lectora" value="{{{ $project->authoring_tool }}}">

            <label>Deployment location</label>
            <input type="radio" name="lms_deployment" value="Client" @if($project->lms_deployment == 'Client') checked @endif> Client
            <input type="radio" name="lms_deployment" value="Sponge" @if($project->lms_deployment == 'Sponge') checked @endif> Launch &amp; Learn

            <label>LMS Specification</label>
            <input name="lms_specification" type="text" placeholder="e.g. SCORM 1.2, SCORM 2004" value="{{{ $project->lms_specification }}}">

            <hr/>

            <label>Project manager</label>
            <input name="project_manager" type="text" placeholder="Start typing a name" value="{{{ $project->project_manager }}}">

            <label>Lead developer</label>
            <input name="lead_developer" type="text" placeholder="Start typing a name" value="{{{ $project->lead_developer }}}">

            <label>Lead designer</label>
            <input name="lead_designer" type="text" placeholder="Start typing a name" value="{{{ $project->lead_designer }}}">

            <label>Instructional designer</label>
            <input name="instructional_designer" type="text" placeholder="Start typing a name" value="{{{ $project->instructional_designer }}}">

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Update details</button>
        </form>

    </div>
    </body>
@stop