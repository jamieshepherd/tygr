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
                    <a href="/projects/{{ $project->client->stub }}/{{ $project->stub }}/issues/create">Log an issue</a>
                </div>
            @endif
            <h1>Log an issue</h1>
        </header>
        @if(Session::has('tip'))
            <div class="tip">
                <i class="fa fa-info-circle"></i> The issue was logged. You can <a href="/{{ Session::get('tip') }}">view it here</a>, <a href="/projects/{{ $project->client->stub }}/{{ $project->stub}}/issues">view all issues</a> or log another below.
            </div>
        @else
            <div class="tip">
                <i class="fa fa-info-circle"></i> You are logging this issue to version <strong>{{ $project->current_version }}</strong> of {{ $project->name }}.
            </div>
        @endif
        <form action="{{{ Request::url() }}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            @if(Auth::user()->rank != 3)
            <input name="hidden" type="checkbox"> Hidden from client?<br/><br/>

            <label>Assign issue</label>
            <input type="radio" name="assigned" value="2" checked> Sponge
            <input type="radio" name="assigned" value="1"> Client
            @endif

            <label>A brief summary of the issue</label>
            <input value="{{ old('summary') }}" name="summary" type="text" placeholder="e.g. Bug, text amend, graphic change" autofocus @if($errors->has('summary')) class="error" >
            <span class="error">{{ $errors->first('summary') }}</span> @else > @endif

            <label>Where did this happen?</label>
            <input value="{{ old('reference') }}" name="reference" type="text" placeholder="e.g. Page 7 or b-09" @if($errors->has('reference')) class="error">
            <span class="error">{{ $errors->first('reference') }}</span> @else > @endif

            <label>Describe the issue</label>
            <textarea name="description" class="large" placeholder="Please be as specific as you can, including details such as text you would like to replace, design changes you require etc." @if($errors->has('description')) class="error" @endif>{{ old('description') }}</textarea>
            @if($errors->has('description')) <span class="error">{{ $errors->first('description') }}</span> @endif

            <label>Attachment (screenshot, document)</label>
            <input name="attachment" type="file" @if($errors->has('attachment')) class="error">
            <span class="error">{{ $errors->first('attachment') }}</span> @else > @endif

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Log issue</button>
            <a class="action red" href="javascript:history.back()"><i class="fa fa-times-circle"></i> Cancel</a>
        </form>
    </div>
@stop
