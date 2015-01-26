@extends('_layout.base')
@section('headlinks')
<script src="/js/list.min.js"></script>
@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<a href="/projects"><li>Projects</li></a>
<a href="/projects/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
<li class="current">Issues</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>All issues</h1>
        <div id="issues">
        <input class="filter search" placeholder="Search" autofocus/>
        <a class="action" href="/projects/{{ $project->stub }}/issues/create"><i class="fa fa-plus-circle"></i> New issue</a>
        <a class="action" href="/projects/{{{ $project->stub }}}/issues/filter/me"><i class="fa fa-check-square-o"></i> Assigned to me</a>
        <a class="action version-dropdown">
            <i class="fa fa-chevron-circle-down"></i> Filter issues
            <ul>
                <li onclick="document.location='/projects/{{{ $project->stub }}}/issues';"><i class="fa fa-angle-right"></i> All issues</li>
                <li onclick="document.location='/projects/{{{ $project->stub }}}/issues/filter/me';"><i class="fa fa-angle-right"></i> Assigned to me</li>
                <li onclick="document.location='/projects/{{{ $project->stub }}}/issues/filter/version1';"><i class="fa fa-angle-right"></i> Version 1</li>
                <li onclick="document.location='/projects/{{{ $project->stub }}}/issues/filter/version2';"><i class="fa fa-angle-right"></i> Version 2</li>
                <li onclick="document.location='/projects/{{{ $project->stub }}}/issues/filter/version3';"><i class="fa fa-angle-right"></i> Version 3</li>
            </ul>
        </a>
        <!--a class="action" href=""><i class="fa fa-bug"></i> All issues</a-->


        <table class="full">
            <tr class="head">
                <th>Ref.</th>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <tbody class="list">
            @foreach($issues as $issue)
            @if($issue->public || Auth::user()->rank <= 2)
            <tr onclick="document.location='{{{ Request::url() }}}/show/{{{ $issue->id }}}';" style="cursor:pointer" @if($issue->status == 'Resolved') class="yes resolved" @endif
                    >
                <td class="reference">{{{ $issue->reference }}}</td>
                <td class="type">{{{ $issue->type }}}</td>
                <td class="description">{{{ substr($issue->description,0,72) }}}...</td>
                <td class="date">{{ date("d M Y",strtotime($issue->created_at)) }}</td>
                <td class="priority @if(Auth::user()->rank < 3) {{ $issue->priority }} @endif">{{{ $issue->status }}}</td>
            </tr>
            @endif
            @endforeach
            </tbody>
        </table>
        </div>
        <script>
            var options = { valueNames: ['reference', 'type', 'description', 'date'] };
            var userList = new List('issues', options);
        </script>
    </div>
</body>
@stop
