@extends('_layout.base')
@section('headlinks')
<script src="/js/chart.min.js"></script>
<script src="/js/chart.defaults.js"></script>
@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Dashboard</li></a>
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
                <div class="col col-2-3">
                    <div class="content">
                        <h3>Something</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, est eveniet illo maiores nisi sed veniam vitae voluptas. Aliquid asperiores consectetur deserunt est minima minus neque officia pariatur quas sit.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim, est eveniet illo maiores nisi sed veniam vitae voluptas. Aliquid asperiores consectetur deserunt est minima minus neque officia pariatur quas sit.</p>
                    </div>
                </div>
                <div class="col col-1-3">
                    <div class="content">
                        <canvas id="issues_by_project"></canvas>
                        <h3>Issues created this week</h3>
                        <script>

                            var issues_by_project_data = [
                                @foreach($data['issues_created'] as $project)
                                {
                                    value: {{ $project->issueCount }},
                                    color: "#f24a33",
                                    highlight: "#71C8B5",
                                    label: "{{ $project->client->name }} ({{ $project->name }})"
                                },
                                @endforeach
                            ];

                            var options = { segmentShowStroke : true }

                            var issues_by_project = document.getElementById("issues_by_project").getContext("2d");
                            new Chart(issues_by_project).Pie(issues_by_project_data, options);

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@stop
