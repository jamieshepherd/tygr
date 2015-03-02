@extends('_layout.base')
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/clients"><li>Clients</li></a>
    <a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
    <li class="current">New version</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')

        <div class="tip">
            <i class="fa fa-info-circle"></i> Creating a new version will archive all of the current issues.
        </div>

        <h1>New version <em>{{{ $project->name }}}</em></h1>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label>Current version</label>
            <input class="short" name="current_version" type="text" placeholder="e.g. Version 1" value="{{{ $project->current_version }}}" disabled>

            <label>New version (recommended)</label>
            <input class="short" name="new_version" type="text" placeholder="e.g. Version 1" value="{{{ $project->current_version + 1 }}}.0" @if($errors->has('new_version')) class="error">
            <span class="error">{{ $errors->first('new_version') }}</span> @else > @endif

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Confirm new version</button>
        </form>
    </div>
@stop
