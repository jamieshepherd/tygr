@extends('layout.base')
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/projects"><li>Projects</li></a>
    <a href="/projects/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
    <a href="/projects/{{{ $project->stub }}}/issues"><li>Issues</li></a>
    <li class="current">Details</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>Issue details</h1>
        <a class="action" href="/projects/{{{ $issue->project->stub }}}/issues/edit/{{ $issue->id }}"><i class="fa fa-plus-circle"></i> Edit issue</a>
        @if($issue->status == 'Resolved')
            <a class="action" href="{{ Request::url() }}/reopen"><i class="fa fa-exclamation-circle"></i> Reopen issue</a>
            <a class="action" href="{{ Request::url() }}/close"><i class="fa fa-check-circle"></i> Close issue</a>
        @else
            <a class="action" href="{{ Request::url() }}/resolve"><i class="fa fa-check-circle"></i> Resolve issue</a>
        @endif
        <section>
            <h2>Details</h2>
            <ul class="details">
                <li><strong>Created by:</strong> {{{ $issue->author->name }}}</li>
                <li><strong>Assigned to:</strong> {{{ isset($issue->assigned_to) ? $issue->assigned_to->name : '' }}}</li>
                <li><strong>Reference:</strong> {{{ $issue->reference }}}</li>
                <li><strong>Issue type:</strong> {{{ $issue->type }}}</li>
                <li><strong>Status:</strong> {{{ $issue->status }}}</li>
                <li><strong>Priority:</strong> {{{ $issue->priority }}}</li>
            </ul>
        </section>
        <section>
            <h2>Description</h2>
            <p>{{{ $issue->description }}}</p>
        </section>
        <section>
            <h2>Update issue</h2>
            <textarea placeholder="Enter a comment here" autofocus></textarea><br/>
            Assign issue <select name="select">
                <option value="client">Sports Direct</option>
                <option value="project_management" selected>Sponge UK (Project Management)</option>
                <option value="development">Sponge UK (Development)</option>
                <option value="visual_design">Sponge UK (Visual Design)</option>
                <option value="instructional_design">Sponge UK (Instructional Design)</option>
            </select>
            <input name="resolved" type="checkbox">Mark as resolved<br/><br/>
            <a class="action" href="#"><i class="fa fa-arrow-circle-right"></i> Update issue</a>
        </section>
        <section>
            <h2>Issue history</h2>
            @foreach($issue->issue_history as $update)
                <div class="update {{ $update->type }}">
                    <div class="timestamp">{{ $update->created_at }}</div>
                    @if($update->type == 'comment')
                        <h3><i class="fa fa-user"></i> {{{ $update->author->name }}} <span class="tag">Sponge UK</span></h3>
                        <p>{{{ $update->comment }}}</p>
                    @elseif($update->type == 'status')
                        @if($update->status == 'created')
                        <h3><i class="fa fa-exclamation-circle"></i> {{{ $update->comment }}} <em>by {{{ $issue->author->name }}}</em></h3>
                        @endif
                        @if($update->status == 'assigned')
                            <h3><i class="fa fa-info-circle"></i> {{{ $update->comment }}} <em>by {{{ $issue->author->name }}}</em></h3>
                        @endif
                        @if($update->status == 'resolved')
                            <h3><i class="fa fa-check-circle"></i> {{{ $update->comment }}} <em>by {{{ $issue->author->name }}}</em></h3>
                        @endif
                    @endif
                </div>
            @endforeach
        </section>

    </div>
</body>
@stop
