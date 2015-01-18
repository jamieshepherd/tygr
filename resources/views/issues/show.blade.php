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
        <a class="action" href="/clients/create"><i class="fa fa-plus-circle"></i> Edit issue</a>
        <a class="action" href="/clients/create"><i class="fa fa-check-circle"></i> Close issue</a>
        <section>
            <h2>Details</h2>
            <ul class="details">
                <li><strong>Created by:</strong> {{{ $issue->author->name }}}</li>
                <li><strong>Assigned to:</strong> {{{ $issue->assigned_to->name }}}</li>
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
            <input name="resolved" type="checkbox"><span class="remember">Mark as resolved</span><br/><br/>
            <a class="action" href="#"><i class="fa fa-arrow-circle-right"></i> Update issue</a>
        </section>
        <section>
            <h2>Issue history</h2>
            <div class="update status">
                <div class="timestamp">14 Feb @ 3:55pm</div>
                <h3><i class="fa fa-check-circle"></i> Issue changed to resolved <em>by John Smith</em></h3>
            </div>
            <div class="update status">
                <div class="timestamp">14 Feb @ 3:55pm</div>
                <h3><i class="fa fa-info-circle"></i> Issue assigned to Sports Direct <em>by Jamie Shepherd</em> </h3>
            </div>
            <div class="update comment">
                <div class="timestamp">14 Feb @ 3:55pm</div>
                <h3><i class="fa fa-user"></i> Jamie Shepherd <span class="tag">Sponge UK</span></h3>
                <p>Hi John, think we've nailed the issue now. Please check through and resolve the issue when you're happy that it's been fixed!</p>
            </div>
            <div class="update status">
                <div class="timestamp">14 Feb @ 3:55pm</div>
                <h3><i class="fa fa-info-circle"></i> Issue assigned to Sponge UK Developers <em>by Jamie Shepherd</em></h3>
            </div>
            <div class="update comment">
                <div class="timestamp">14 Feb @ 3:55pm</div>
                <h3><i class="fa fa-user"></i> Jamie Shepherd <span class="tag">Sponge UK</span></h3>
                <p>I think this is an important issue. We'll have to get back to you after some internal testing to make sure this component works correctly, at the moment it does not.</p>
            </div>
            <div class="update status">
                <div class="timestamp">14 Feb @ 3:55pm</div>
                <h3><i class="fa fa-exclamation-circle"></i> Issue was created <em>by John Smith</em></h3>
            </div>
        </section>

    </div>
</body>
@stop
