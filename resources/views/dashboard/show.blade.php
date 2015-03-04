@extends('_layout.base')
@section('headlinks')
<script src="/js/chart.min.js"></script>
<script src="/js/chart.defaults.js"></script>
@stop
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
                    <a href="/">Dashboard</a>
                </div>
            @endif
            <h1>Dashboard</h1>
        </header>
                <div class="statistics">
                    <div class="statistic">
                        <div class="content first">
                        <h2 class="blue">{{ $data['client_count'] }}</h2>
                        <label>Total clients</label>
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="content">
                        <h2 class="yellow">{{ $data['project_count'] }}</h2>
                        <label>Total projects</label>
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="content">
                        <h2 class="red">{{ $data['issue_count'] }}</h2>
                        <label>Open issues</label>
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="content">
                        <h2 class="green">{{ $data['issues_resolved'] }}</h2>
                        <label>Resolved this week</label>
                        </div>
                    </div>
                </div>
        <div class="dashboard">
            <div class="row">
                <div class="col col-1-3">
                    <div class="content">
                        <h1>What is the dashboard?</h1>
                        <p>This is just a small snapshot of some of the information that happened in the last 7 days. Eventually this should be a full dashboard of everything you might want to know at a glance.</p>
                        <p>We're looking to add some more interesting statistics, graphs, and notifications as the service improves. If you have any ideas <a href="mailto:email@jamie.sh">let me know!</a></p>
                    </div>
                </div>
                <div class="col col-2-3">
                    <div class="content stats">
                        <canvas id="issues_by_project"></canvas><br><br><br>
                        <h3>Issues created this week by project</h3>
                        <script>

                            var issues_by_project_data = [
                                @foreach($data['issues_created'] as $project)
                                {
                                    value: {{ $project->issueCount }},
                                    color: "{{ $project->color }}",
                                    highlight: "#71C8B5",
                                    label: "{{ $project->client->name }} ({{ $project->name }})"
                                },
                                @endforeach
                            ];

                            var options = { segmentShowStroke : true }

                            var issues_by_project = document.getElementById("issues_by_project").getContext("2d");
                            new Chart(issues_by_project).Doughnut(issues_by_project_data, options);

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
