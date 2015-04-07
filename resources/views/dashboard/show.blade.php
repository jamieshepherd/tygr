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
                        <div class="content second">
                        <h2 class="yellow">{{ $data['project_count'] }}</h2>
                        <label>Total projects</label>
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="content third">
                        <h2 class="red">{{ $data['issue_count'] }}</h2>
                        <label>Open amendments</label>
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="content fourth">
                        <h2 class="green">{{ $data['issues_resolved'] }}</h2>
                        <label>Resolved this week</label>
                        </div>
                    </div>
                </div>
        <div class="dashboard">
            <div class="row">
                <div class="col col-1-2">
                    <div class="content stats">
                        <h4>Amendments created this week by project</h4>
                        <canvas id="issues_by_project"></canvas>
                        <script>

                            var data = {

                                labels: [@foreach($data['issues_created'] as $project)"{{ $project->name }}", @endforeach],
                                datasets: [
                                    {
                                        label: "Issues by project",
                                        fillColor: "rgba(57,209,180,1)",
                                        strokeColor: "rgba(220,220,220,0.8)",
                                        highlightFill: "rgba(139,206,220,0.5)",
                                        highlightStroke: "rgba(57,209,180,0.5)",
                                        data: [@foreach($data['issues_created'] as $project){{ $project->issueCount }}, @endforeach]
                                    }
                                ]

                            };

                            var issues_by_project = document.getElementById("issues_by_project").getContext("2d");
                            new Chart(issues_by_project).Bar(data, {
                                barShowStroke: false
                            });

                        </script>
                    </div>
                </div>
                <div class="col col-1-2">
                    <div class="content">
                        <h1>What is the dashboard?</h1>
                        <p>This is just a small snapshot of some of the information that happened in the last 7 days. Eventually this should be a full dashboard of everything you might want to know at a glance.</p>
                        <p>We're looking to add some more interesting statistics, graphs, and notifications as the service improves. If you have any ideas <a href="mailto:email@jamie.sh">let me know!</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop
