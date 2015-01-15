@extends('layout.base')
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/projects"><li>Projects</li></a>
    <a href="/projects/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
    <a href="/projects/{{{ $project->stub }}}/issues"><li>Issues</li></a>
    <li class="current">{{ $issue->id }}</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>Issue details</h1>
        <h2>Description</h2>
        <div class="info-box">
            <table>
                <tr><td><strong>Assigned to</strong></td><td>Jamie Shepherd</td></tr>
                <tr><td><strong>Reference</strong></td><td>{{{ $issue->reference }}}</td></tr>
                <tr><td><strong>Issue type</strong></td><td>{{{ $issue->type }}}</td></tr>
                <tr><td><strong>Author</strong></td><td>{{ $issue->author }}</td></tr>
                <tr><td><strong>Status</strong></td><td>{{ $issue->status }}</td></tr>
                <tr><td><strong>Priority</strong></td><td><i class="fa fa-exclamation-circle"></i> {{ ucfirst($issue->priority) }}</td></tr>
            </table>
            <hr/>
            <table>
                <tr><td><strong>Created</strong></td><td>{{ $issue->created_at }}</td></tr>
                <tr><td><strong>Updated</strong></td><td>{{ $issue->updated_at }}</td></tr>
            </table>
        </div>
        <p>{{{ $issue->description }}}</p>
        <h2>Screenshots</h2>
        <img src="http://placehold.it/300x200">
        <img src="http://placehold.it/300x200">
        <h2>Comments</h2>
        <p>There are no comments.</p>
        <textarea placeholder="Enter a comment here"></textarea><br/>
        <a class="action" href="#"><i class="fa fa-arrow-circle-right"></i> Post comment</a>
        <a class="action" href="#"><i class="fa fa-check-circle"></i> Mark as resolved</a>
    </div>
</body>
@stop
