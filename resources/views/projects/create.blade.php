@extends('_layout.base')
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/clients"><li>Clients</li></a>
    <a href="/clients/show/{{{ $client->stub }}}"><li>{{{ $client->name }}}</li></a>
    <li class="current">Create project</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>Create project</h1>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            @if(Auth::user()->rank != 3)
            <input name="hidden" type="checkbox"> Hidden from client?
            @endif

            <label>Project name</label>
            <input value="{{ old('name') }}" id="name" name="name" type="text" placeholder="e.g. Fire Safety" value="" onkeyup="generateStub()" @if($errors->has('name')) class="error">
            <span class="error">{{ $errors->first('name') }}</span> @else > @endif

            <label>Project stub<em>(Used for URLs)</em></label>
            <input value="{{ old('stub') }}" id="stub" name="stub" type="text" placeholder="e.g. firesafety" @if($errors->has('stub')) class="error">
            <span class="error">{{ $errors->first('stub') }}</span> @else > @endif

            <label>Current version</label>
            <input value="{{ old('current_version') }}" name="current_version" type="text" placeholder="e.g. 1.0" @if($errors->has('current_version')) class="error">
            <span class="error">{{ $errors->first('current_version') }}</span> @else > @endif

            <label>Project status</label>
            <input value="{{ old('status') }}" name="status" type="text" placeholder="e.g. In development, Launched" @if($errors->has('status')) class="error">
            <span class="error">{{ $errors->first('status') }}</span> @else > @endif

            <hr/>

            <label>Authoring Tool</label>
            <input value="{{ old('authoring_tool') }}" name="authoring_tool" type="text" placeholder="e.g. Adapt, Storyline, Lectora" @if($errors->has('authoring_tool')) class="error">
            <span class="error">{{ $errors->first('authoring_tool') }}</span> @else > @endif

            <label>Deployment location</label>
            <input type="radio" name="lms_deployment" value="client"> Client
            <input type="radio" name="lms_deployment" value="sponge"> Launch &amp; Learn
            @if($errors->has('lms_deployment'))
            <span class="error">{{ $errors->first('lms_deployment') }}</span> @endif

            <label>LMS Specification</label>
            <input value="{{ old('lms_specification') }}" name="lms_specification" type="text" placeholder="e.g. SCORM 1.2, SCORM 2004" @if($errors->has('lms_specification')) class="error">
            <span class="error">{{ $errors->first('lms_specification') }}</span> @else > @endif

            <hr/>

            <label>Project manager</label>
            <input value="{{ old('project_manager') }}" name="project_manager" type="text" placeholder="Start typing a name" @if($errors->has('project_manager')) class="error">
            <span class="error">{{ $errors->first('project_manager') }}</span> @else > @endif

            <label>Lead developer</label>
            <input value="{{ old('lead_developer') }}" name="lead_developer" type="text" placeholder="Start typing a name" @if($errors->has('lead_developer')) class="error">
            <span class="error">{{ $errors->first('lead_developer') }}</span> @else > @endif

            <label>Lead designer</label>
            <input value="{{ old('lead_designer') }}" name="lead_designer" type="text" placeholder="Start typing a name" @if($errors->has('lead_designer')) class="error">
            <span class="error">{{ $errors->first('lead_designer') }}</span> @else > @endif

            <label>Instructional designer</label>
            <input value="{{ old('instructional_designer') }}" name="instructional_designer" type="text" placeholder="Start typing a name" @if($errors->has('instructional_designer')) class="error">
            <span class="error">{{ $errors->first('instructional_designer') }}</span> @else > @endif

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Create project</button>
        </form>

    </div>
    </body>
@stop
