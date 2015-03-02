@extends('_layout.base')
@section('headlinks')
@stop
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/projects"><li>Projects</li></a>
    <a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
    <a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}/issues"><li>Issues</li></a>
    <li class="current">Create</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        @if(Session::has('tip'))
            <div class="tip">
                <i class="fa fa-info-circle"></i> The issue was logged. You can <a href="/{{ Session::get('tip') }}">view it here</a>, <a href="/{{ $project->client->stub }}/{{ $project->stub}}/issues">view all issues</a> or log another below.
            </div>
        @else
            <div class="tip">
                <i class="fa fa-info-circle"></i> You are logging this issue to version <strong>{{ $project->current_version }}</strong> of {{ $project->name }}.
            </div>
        @endif
        <h1>Log an issue</h1>
        <form action="{{{ Request::url() }}}" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            @if(Auth::user()->rank != 3)
            <input name="hidden" type="checkbox"> Hidden from client?

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
        </form>
    </div>
@stop
