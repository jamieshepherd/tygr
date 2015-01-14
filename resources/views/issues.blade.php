@extends('layout.base')
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        <header>
            <ul class="crumbtrail">
                <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
                <a href="/clients/{{{ $client->stub }}}"><li>{{{ $client->name }}}</li></a>
                <a href="/clients/{{{ $client->stub }}}/projects/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
                <li class="current">Issues</li>
            </ul>
            <ul class="account">
                <a href="#"><li><i class="fa fa-lock"></i> Account</li></a>
                <a href="/auth/logout"><li><i class="fa fa-sign-out"></i> Sign out</li></a>
            </ul>
        </header>
        <h1>All issues</h1>
        <div id="issues">
        <input class="filter search" placeholder="Search" />
        <a class="action" href="/clients/{{ $client->stub }}/projects/{{ $project->stub }}/issues/create"><i class="fa fa-plus-circle"></i> New issue</a>
        <a class="action" href=""><i class="fa fa-bug"></i> All issues</a>
        <a class="action" href=""><i class="fa fa-bug"></i> Assigned to me</a>

        <table class="full">
            <tr>
                <th>Ref.</th>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <tbody class="list">
            @foreach($issues as $issue)
            <tr onclick="document.location='/clients/{{{ $client->stub }}}/projects/{{{ $project->stub }}}/issues/show/{{{ $issue->id }}}';" style="cursor:pointer">
                <td class="reference">{{{ $issue->reference }}}</td>
                <td class="type">{{{ $issue->type }}}</td>
                <td class="description">{{{ substr($issue->description,0,72) }}}...</td>
                <td class="date">{{ date("m-d-y",strtotime($issue->created_at)) }}</td>
                <td class="priority {{ $issue->priority }}">{{{ $issue->status }}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <script src="/js/list.js"></script>
        <script>
            var options = { valueNames: ['reference', 'type', 'description', 'date'] };
            var userList = new List('issues', options);
        </script>
    </div>
</body>
@stop