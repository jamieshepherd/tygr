@extends('_layout.base')
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
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>Edit <em>{{{ $project->name }}}</em></h1>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            @if(Auth::user()->rank == 3)
            <input name="hidden" type="checkbox" @if($project->public) checked @endif> Hidden from client?
            @endif

            <label>Project name</label>
            <input id="name" name="name" type="text" placeholder="e.g. Fire Safety" value="{{{ $project->name }}}" onkeyup="generateStub()" @if($errors->has('name')) class="error">
            <span class="error">{{ $errors->first('name') }}</span> @else > @endif

            <!--label>Project stub<em>(Used for URLs)</em></label>
            <input id="stub" name="stub" type="text" placeholder="e.g. firesafety" value="{{{ $project->stub }}}" @if($errors->has('stub')) class="error">
            <span class="error">{{ $errors->first('stub') }}</span> @else > @endif!-->

            <label>Current version</label>
            <input name="current_version" type="text" placeholder="e.g. Version 1" value="{{{ $project->current_version }}}" @if($errors->has('current_version')) class="error">
            <span class="error">{{ $errors->first('current_version') }}</span> @else > @endif

            <label>Project status</label>
            <input name="status" type="text" placeholder="e.g. In development, Launched" value="{{{ $project->status }}}" @if($errors->has('status')) class="error">
            <span class="error">{{ $errors->first('status') }}</span> @else > @endif

            <hr/>

            <label>Authoring Tool</label>
            <input name="authoring_tool" type="text" placeholder="e.g. Adapt, Storyline, Lectora" value="{{{ $project->authoring_tool }}}" @if($errors->has('authoring_tool')) class="error">
            <span class="error">{{ $errors->first('authoring_tool') }}</span> @else > @endif

            <label>Deployment location</label>
            <input type="radio" name="lms_deployment" value="Client" @if($project->lms_deployment == 'Client') checked @endif> Client
            <input type="radio" name="lms_deployment" value="Sponge" @if($project->lms_deployment == 'Sponge') checked @endif> Launch &amp; Learn

            <label>LMS Specification</label>
            <input name="lms_specification" type="text" placeholder="e.g. SCORM 1.2, SCORM 2004" value="{{{ $project->lms_specification }}}" @if($errors->has('lms_specification')) class="error">
            <span class="error">{{ $errors->first('lms_specification') }}</span> @else > @endif

            <hr/>

            <label>Project manager</label>
            <input name="project_manager" type="text" placeholder="Start typing a name" value="{{{ $project->project_manager }}}" @if($errors->has('project_manager')) class="error">
            <span class="error">{{ $errors->first('project_manager') }}</span> @else > @endif

            <label>Lead developer</label>
            <input name="lead_developer" type="text" placeholder="Start typing a name" value="{{{ $project->lead_developer }}}" @if($errors->has('lead_developer')) class="error">
            <span class="error">{{ $errors->first('lead_developer') }}</span> @else > @endif

            <label>Lead designer</label>
            <input name="lead_designer" type="text" placeholder="Start typing a name" value="{{{ $project->lead_designer }}}" @if($errors->has('lead_designer')) class="error">
            <span class="error">{{ $errors->first('lead_designer') }}</span> @else > @endif

            <label>Instructional designer</label>
            <input name="instructional_designer" type="text" placeholder="Start typing a name" value="{{{ $project->instructional_designer }}}" @if($errors->has('instructional_designer')) class="error">
            <span class="error">{{ $errors->first('instrucitonal_designer') }}</span> @else > @endif

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Update details</button>
        </form>

    </div>
    </body>
@stop
