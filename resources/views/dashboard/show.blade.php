@extends('_layout.base')
@section('headlinks')
<script src="/js/chart.min.js"></script>
<script src="/js/chart.defaults.js"></script>
@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>Dashboard</h1>
        <div class="dashboard">
            <div class="row">
                <div class="col col-1-4 ">
                    <div class="content stats">
                        <h2>{{ $data['client_count'] }}</h2>
                        <h3>Total clients</h3>
                    </div>
                </div>
                <div class="col col-1-4">
                    <div class="content stats">
                        <h2>{{ $data['project_count'] }}</h2>
                        <h3>Total projects</h3>
                    </div>
                </div>
                <div class="col col-1-4">
                    <div class="content stats">
                        <h2>{{ $data['issue_count'] }}</h2>
                        <h3>Open issues</h3>
                    </div>
                </div>
                <div class="col col-1-4">
                    <div class="content stats">
                        <h2>{{ $data['issues_resolved'] }}</h2>
                        <h3>Issues resolved this week</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-1-2">
                    <div class="content">
                        <h1>What is the dashboard?</h1>
                        <p>This is just a small snapshot of some of the information that happened in the last 7 days. Eventually this should be a full dashboard of everything you might want to know at a glance.</p>
                        <p>We're looking to add some more interesting statistics, graphs, and notifications as the service improves. If you have any ideas <a href="mailto:email@jamie.sh">let me know!</a></p>
                    </div>
                </div>
                <div class="col col-1-2">
                    <div class="content stats">
                        <canvas id="issues_by_project"></canvas><br>
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
</body>
@stop
