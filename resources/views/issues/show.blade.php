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
                    <a href="/projects/{{ $issue->project->client->stub }}/{{ $issue->project->stub }}">{{ $issue->project->name }}</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/projects/{{ $issue->project->client->stub }}/{{ $issue->project->stub }}/issues">Amendments</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/projects/{{ $issue->project->client->stub }}/{{ $issue->project->stub }}/issues/show/{{ $issue->id }}">{{ $issue->summary }}</a>
                </div>
            @endif
            <h1>{{ $issue->summary }}</h1>
        </header>
        @if($issue->status == 'Resolved')
            <a class="action" href="{{ Request::url() }}/close"><i class="fa fa-check-circle"></i> Close</a>
            <a class="action red" href="{{ Request::url() }}/reopen"><i class="fa fa-exclamation-circle"></i> Reopen</a>
        @elseif($issue->status === 'Closed')
            <a class="action" href="{{ Request::url() }}/reopen"><i class="fa fa-exclamation-circle"></i> Reopen</a>
        @else
            <a class="action" href="{{ Request::url() }}/resolve"><i class="fa fa-check-circle"></i> Resolve</a>
        @endif
        <a class="action yellow" href="/projects/{{ $issue->project->client->stub }}/{{{ $issue->project->stub }}}/issues/edit/{{ $issue->id }}"><i class="fa fa-plus-circle"></i> Edit</a>
        @if(Auth::user()->rank <= 2)
        <a class="action blue" href="/projects/{{ $issue->project->client->stub }}/{{{ $issue->project->stub }}}/issues/claim/{{ $issue->id }}"><i class="fa fa-thumb-tack"></i> Claim</a>
        <span class="action yellow button-dropdown">
            <i class="fa fa-flask"></i> Change version <i class="fa fa-caret-down"></i>
            <ul>
                @foreach($versions as $version)
                <li>
                    <a href="/projects/{{ $issue->project->client->stub }}/{{{ $issue->project->stub }}}/issues/version/{{ $issue->id }}?version={{ $version->version }}">
                        <i class="fa fa-angle-right"></i> {{ $version->version }}
                    </a>
                </li>
                @endforeach
            </ul>
        </span>
        @endif
        <section>
            <h2>Details</h2>
            <ul class="details">
                <li><strong>Created by:</strong> {{{ $issue->author->name }}}</li>
                <li><strong>Assigned to:</strong> @if($issue->assigned() == 'Client') {{{ $issue->project->client->name }}} @else {{{ $issue->assigned() }}} @endif</li>
                <li><strong>Reference:</strong> {{{ $issue->reference }}}</li>
                <li><strong>Status:</strong> {{{ $issue->status }}}</li>
                @if(Auth::user()->rank != 3)
                    <li><strong>Priority:</strong> {{{ $issue->priority }}}</li>
                    @if($issue->claimed_by != null)
                        <li><strong>Claimed by:</strong> {{{ $issue->claimed_by->name }}}</li>
                    @endif
                @endif
                <li><strong>Version:</strong> {{ $issue->version }}</li>
                <li><strong>Last updated:</strong> {{ date("d M Y",strtotime($issue->updated_at)) }}</li>
            </ul>
        </section>
        <section class="formatted">
            <h2>Description</h2>
            <script>hljs.initHighlightingOnLoad();</script>
            {!! (new Parsedown())->setMarkupEscaped(true)->text($issue->description) !!}
        </section>
        @if(count($issue->attachments) > 0)
        <section>
            <h2>Attachments</h2>
            <ul class="attachments">
                @foreach($issue->attachments as $attachment)
                    <li class="attachment-item">
                        @include('_components.filetype')
                        <a href="/projects/{{ $issue->project->client->stub }}/{{ $issue->project->stub }}/uploads/{{ $attachment->filename }}" target="_blank">{{ $attachment->filename }}</a> <a class="attachment-delete" href="/projects/{{ $issue->project->client->stub }}/{{ $issue->project->stub }}/uploads/{{ $attachment->id }}/delete"><i class="fa fa-times"></a></i></li>
                @endforeach
            </ul>
        </section>
        @endif
        @if($issue->status != 'Resolved' && $issue->status != 'Closed')
        <section>
            <h2>Update amendment</h2>
            <form action="" method="POST" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <textarea name="comment" placeholder="Enter a comment here" autofocus></textarea>

                @if(Auth::user()->rank != 3)
                    <input name="hidden" type="checkbox"> Internal comment<br/><br/>
                @endif

                <label>Reassign</label>
                <select name="assigned_to">
                    @foreach($groups as $group)
                        <option value="{{ $group->id }}" @if($issue->assigned_to_id == $group->id) selected @endif>@if($group->name == 'Client') {{ $issue->project->client->name }} @else{{ $group->name }}@endif</option>
                    @endforeach
                </select>

                <label>Add attachment</label>
                <input type="file" name="attachment" />

                <br/>
                <button type="submit"><i class="fa fa-arrow-circle-right"></i> Update</button>

            </form>
        </section>
        @endif
        @include('issues.history')
    </div>
@stop
