@extends('_layout.base')
@section('headlinks')
    <script src="/js/list.min.js"></script>
@stop
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/projects"><li>Projects</li></a>
    <a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}"><li>{{{ $project->name }}}</li></a>
    <li class="current">Issues</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>Issues @if(isset($filter)) <em>({{{ $filter }}})</em> @else <em>({{{ $project->current_version }}})</em>@endif</h1>
        <div id="issues">
            <input class="filter search" placeholder="Search" autofocus/>
            <a class="action" href="/projects/{{ $project->client->stub }}/{{ $project->stub }}/issues/create"><i class="fa fa-plus-circle"></i> New issue</a>
            <a class="action version-dropdown">
                <i class="fa fa-chevron-circle-down"></i> Filter issues
                <ul>
                    <li onclick="document.location='/projects/{{ $project->client->stub }}/{{{ $project->stub }}}/issues/filter/all';"><i class="fa fa-angle-right"></i> All issues</li>
                    <li onclick="document.location='/projects/{{ $project->client->stub }}/{{{ $project->stub }}}/issues/filter/me';"><i class="fa fa-angle-right"></i> Assigned to me</li>
                    @foreach($versions as $version)
                        <li onclick="document.location='/projects/{{ $project->client->stub }}/{{{ $project->stub }}}/issues/filter/{{ $version->version }}';"><i class="fa fa-angle-right"></i> {{ $version->version }}</li>
                    @endforeach
                </ul>
            </a>
            <a class="action" href="{{ Request::url() }}/print"><i class="fa fa-print"></i> Print</a>
            <!--a class="action" href=""><i class="fa fa-bug"></i> All issues</a-->


            <table class="full">
                <tr class="head">
                    <th class="select"><input type="checkbox"></th>
                    <th>Reference</th>
                    <th>Details</th>
                    <th>Assigned</th>
                    <th>Status</th>
                </tr>
                <tbody class="list">
                @foreach($issues as $issue)
                    @if(!$issue->hidden || Auth::user()->rank <= 2)
                        <tr>
                            <td class="select"><input type="checkbox"></td>
                            <td class="reference">{{{ $issue->reference }}}</td>
                            <td class="details">
                                <span class="type">{{{ $issue->type }}}</span>
                                <span class="description">{{{ substr($issue->description,0,80) }}}...</span>
                                <span class="details"><i class="fa fa-calendar"></i> {{ date("d M Y",strtotime($issue->created_at)) }} <i class="fa fa-diamond"></i> {{ $issue->version }} <i class="fa fa-user"></i> Ben Aslett</span>
                            </td>
                            <td class="assigned">
                                Sponge UK
                            </td>
                            <td class="status">
                                {{{ $issue->status->name }}}
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <script>
            var options = { valueNames: ['reference', 'type', 'description', 'date', 'priority'] };
            var userList = new List('issues', options);
        </script>
    </div>
    </body>
@stop
