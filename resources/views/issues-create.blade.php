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
            <label>Project version</label>
            <select name="version">
                <option value="v1">Version 1</option>
                <option value="v2">Version 2</option>
                <option value="v3">Version 3</option>
                <option value="extra">Extra</option>
            </select>

            <label>Reference (Page / block)</label>
            <input type="text" name="reference" placeholder="e.g. Page 1 / b-05">

            <label>Issue type</label>
            <input type="radio" name="type" value="bugfix"><label class="radio">Bug fix</label>
            <input type="radio" name="type" value="text"><label class="radio">Text amend</label>
            <input type="radio" name="type" value="design"><label class="radio">Design amend</label>

            <label>Description</label>
            <textarea name="description" class="large" placeholder="Please be as specific as you can, including details on how to reproduce the issue, browser (IE/Chrome) and operating system."></textarea>

            <label>Screenshots</label>
            <input type="file">

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Save issue</button>
        </form>

    </div>
    </body>
@stop
