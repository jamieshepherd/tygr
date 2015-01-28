@extends('_layout.base')
@section('headlinks')
@stop
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/projects"><li>Projects</li></a>
    <a href="/projects/{{ $issue->project->client->stub }}/{{{ $issue->project->stub }}}"><li>{{{ $issue->project->name }}}</li></a>
    <a href="/projects/{{ $issue->project->client->stub }}/{{{ $issue->project->stub }}}/issues"><li>Issues</li></a>
    <li class="current">Create</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>Log an issue</h1>
        <form action="{{{ Request::url() }}}" method="POST" accept-charset="UTF-8">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <input name="public" type="checkbox" @if($issue->public) checked @endif> Visible to client?

            <label>What type of issue is this?</label>
            <input name="type" type="text" placeholder="e.g. Bug, text amend, design" autofocus value="{{{ $issue->type }}}">

            <label>Where did this happen?</label>
            <input name="reference" type="text" placeholder="e.g. Page 7 or b-09" value="{{{ $issue->reference }}}">

            <label>Describe the issue</label>
            <textarea name="description" class="large" placeholder="Please be as specific as you can, including details on how to reproduce the issue, browser (IE/Chrome) and operating system.">{{{ $issue->description }}}</textarea>

            <label>Attachments (screenshots, documents)</label>
            <input type="file" name="file" />

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Log issue</button>
        </form>

    </div>
    </body>
@stop
