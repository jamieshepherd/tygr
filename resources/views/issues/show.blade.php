@extends('_layout.base')
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/projects"><li>Projects</li></a>
    <a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
    <a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}/issues"><li>Issues</li></a>
    <li class="current">Details</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>Issue details</h1>
        <a class="action" href="/projects/{{ $project->client->stub }}/{{{ $issue->project->stub }}}/issues/edit/{{ $issue->id }}"><i class="fa fa-plus-circle"></i> Edit issue</a>
        <a class="action" href="/projects/{{ $project->client->stub }}/{{{ $issue->project->stub }}}/issues/claim/{{ $issue->id }}"><i class="fa fa-plus-circle"></i> Claim issue</a>
        @if($issue->status->name == 'Resolved')
            <a class="action" href="{{ Request::url() }}/reopen"><i class="fa fa-exclamation-circle"></i> Reopen issue</a>
            <a class="action" href="{{ Request::url() }}/close"><i class="fa fa-check-circle"></i> Close issue</a>
        @elseif($issue->status->name === 'Closed')
            <a class="action" href="{{ Request::url() }}/reopen"><i class="fa fa-exclamation-circle"></i> Reopen issue</a>
        @else
            <a class="action" href="{{ Request::url() }}/resolve"><i class="fa fa-check-circle"></i> Resolve issue</a>
        @endif
        <section>
            <h2>Details</h2>
            <ul class="details">
                <li><strong>Created by:</strong> {{{ $issue->author->name }}}</li>
                <li><strong>Assigned to:</strong> @if($issue->assigned() == 'Client') {{{ $issue->project->client->name }}} @else {{{ $issue->assigned() }}} @endif</li>
                <li><strong>Reference:</strong> {{{ $issue->reference }}}</li>
                <li><strong>Status:</strong> {{{ $issue->status->name }}}</li>
                @if(Auth::user()->rank != 3)
                    <li><strong>Priority:</strong> {{{ $issue->priority }}}</li>
                    <li><strong>Claimed by:</strong> {{{ $issue->claimed_by->name }}}</li>
                @endif
                <li><strong>Version:</strong> {{ $issue->version }}</li>
                <li><strong>Last updated:</strong> {{ date("d M Y",strtotime($issue->updated_at)) }}</li>
            </ul>
        </section>
        <section>
            <h2>{{ $issue->summary }}</h2>
            <p>{{{ $issue->description }}}</p>
        </section>
        @if(count($issue->attachments) > 0)
        <section>
            <h2>Attachments</h2>
            <ul class="attachments">
                @foreach($issue->attachments as $attachment)
                    <li>
                        @include('_components.filetype')
                        <a href="/uploads/{{ $issue->id }}/{{ $attachment->filename }}">{{ $attachment->filename }}</a></li>
                @endforeach
            </ul>
        </section>
        @endif
        @if($issue->status->name != 'Resolved' && $issue->status->name != 'Closed')
        <section>
            <h2>Update issue</h2>
            <form action="" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <textarea name="comment" placeholder="Enter a comment here" autofocus></textarea>

                <label>Add attachment</label>
                <input type="file" name="attachment" />

                <label>Assign issue</label>
                @if(Auth::user()->rank == 3)
                    <input type="radio" name="assigned_to" value="1" @if($issue->assigned_to_id == 1) checked @endif> {{{ $issue->project->client->name }}}<br/>
                    <input type="radio" name="assigned_to" value="2" @if($issue->assigned_to_id == 2) checked @endif> Sponge UK
                @else
                    <input type="radio" name="assigned_to" value="1" @if($issue->assigned_to_id == 1) checked @endif> {{{ $issue->project->client->name }}} (Client)<br/>
                    <input type="radio" name="assigned_to" value="2" @if($issue->assigned_to_id == 2) checked @endif> Sponge UK<br/>
                    <input type="radio" name="assigned_to" value="3" @if($issue->assigned_to_id == 3) checked @endif> Sponge UK (Project Management)<br/>
                    <input type="radio" name="assigned_to" value="4" @if($issue->assigned_to_id == 4) checked @endif> Sponge UK (Development)<br/>
                    <input type="radio" name="assigned_to" value="5" @if($issue->assigned_to_id == 5) checked @endif> Sponge UK (Visual Design)<br/>
                    <input type="radio" name="assigned_to" value="6" @if($issue->assigned_to_id == 6) checked @endif> Sponge UK (Instructional Design)

                    <label>Issue priority</label>
                    <input type="radio" name="priority" value="High" @if($issue->priority == 'High') checked @endif> High
                    <input type="radio" name="priority" value="Medium" @if($issue->priority == 'Medium') checked @endif> Medium
                    <input type="radio" name="priority" value="Low" @if($issue->priority == 'Low') checked @endif> Low
                @endif
                <label>Mark as resolved</label>
                <input name="resolved" type="checkbox"> Resolved<br/>
                <button type="submit"><i class="fa fa-arrow-circle-right"></i> Update issue</button>

            </form>
        </section>
        @endif
        @include('issues.history')
    </div>
</body>
@stop
