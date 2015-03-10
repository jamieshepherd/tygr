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
                    <a href="/projects/{{ $project->client->stub }}/{{ $project->stub }}">{{ $project->name }}</a>
                </div>
            @endif
            <h1>{{ $project->name }}</h1>
        </header>
        <a class="action" href="{{ Request::url() }}/issues/create"><i class="fa fa-plus-circle"></i> New amendment</a>
        @if(Auth::user()->rank <= 2)
            <a class="action green" href="{{ Request::url() }}/version"><i class="fa fa-flask"></i> New version</a>
            <a class="action yellow" href="{{ Request::url() }}/edit"><i class="fa fa-edit"></i> Edit project</a>
        @endif
        <a class="action blue" href="{{ Request::url() }}/issues"><i class="fa fa-bug"></i> View amendments</a>
        <a class="action blue" href="http://reviewarea.co.uk/Secure/{{ $project->client->stub }}"><i class="fa fa-desktop"></i> Review area</a>
        <br/><br/><br/>
        <div class="statistics">
            <div class="statistic">
                <div class="content first">
                    <h2 class="blue">{{ $project->current_version }}</h2>
                    <label>Current version</label>
                </div>
            </div>
            <div class="statistic">
                <div class="content second">
                    <h2 class="yellow">{{ $projectStats['assignedToYou'] }}</h2>
                    <label>Assigned to you</label>
                </div>
            </div>
            <div class="statistic">
                <div class="content third">
                    <h2 class="red">{{ $projectStats['openIssues'] }}</h2>
                    <label>Open amendments</label>
                </div>
            </div>
            <div class="statistic">
                <div class="content fourth">
                    <h2 class="green">{{ $projectStats['resolvedIssues'] }}</h2>
                    <label>Resolved this week</label>
                </div>
            </div>
        </div>
        <div class="dashboard">
            <div class="row">
                <div class="col col-1-2">
                    <div class="content">
                        <h4>Recent activity</h4>
                        @if(count($issueHistory) == 0)
                            <p>No recent activity. Perhaps you would like to <a href="{{ Request::url() }}/issues/create">log an amendment</a>?</p>
                        @endif
                        @foreach($issueHistory as $activity)
                        <div class="activity">
                            <img class="user-icon" src="/images/user-icon.png"/>
                            <div class="details">
                                <p><strong>{{ $activity->author->name }}</strong> {{ $activity->status }} @if($activity->type == 'comment') commented on @endif the amendment <a href="{{ Request::url() }}/issues/show/{{ $activity->issue_id }}">{{ $activity->issue->summary }}</a>.</p>
                                <span class="date">{{ date("d M Y @ H:i",strtotime($activity->created_at)) }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col col-1-2">
                    <div class="content">
                        <h4>Project details</h4>
                        <table class="project-details">
                            <tr><td><strong>Project manager</strong></td><td>{{{ $project->project_manager }}}</td></tr>
                            <tr><td><strong>Lead developer</strong></td><td>{{{ $project->lead_developer }}}</td></tr>
                            <tr><td><strong>Lead designer</strong></td><td>{{{ $project->lead_designer }}}</td></tr>
                            <tr><td><strong>Instructional designer</strong></td><td>{{{ $project->instructional_designer }}}</td></tr>
                            <tr><td><strong>Authoring tool</strong></td><td>{{{ $project->authoring_tool }}}</td></tr>
                            <tr><td><strong>LMS Deployment</strong></td><td>{{{ $project->lms_deployment }}}</td></tr>
                            <tr><td><strong>Specification</strong></td><td>{{{ $project->lms_specification }}}</td></tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
