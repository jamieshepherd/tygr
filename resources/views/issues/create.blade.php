@extends('layout.base')
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/clients/{{{ $client->stub }}}"><li>{{{ $client->name }}}</li></a>
    <a href="/clients/{{{ $client->stub }}}/projects/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
    <a href="/clients/{{{ $client->stub }}}/projects/{{{ $project->stub }}}/issues"><li>Issues</li></a>
    <li class="current">Create</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>Log an issue</h1>
        <form action="" method="POST" accept-charset="UTF-8">

            <label>What type of issue is this?</label>
            <input type="text" placeholder="LMS error, text amend, graphic amend" autofocus>

            <label>Where did this happen?</label>
            <input type="text" placeholder="e.g. Page 7 or b-09">

            <label>Describe the issue</label>
            <textarea name="description" class="large" placeholder="Please be as specific as you can, including details on how to reproduce the issue, browser (IE/Chrome) and operating system."></textarea>

            <label>Attachments (screenshots, documents)</label>
            <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Log issue</button>
        </form>

    </div>
    </body>
@stop