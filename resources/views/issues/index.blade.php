@extends('_layout.base')
@section('headlinks')
    <script src="/js/list.min.js"></script>
    <script src="/js/sortable.min.js"></script>
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


            <table class="full" data-sortable>
                <thead>
                    <tr class="head">
                        <th class="select" data-sortable="false" data-sorted="false"><input type="checkbox" onchange="selectAll(this)"></th>
                        <th>Reference <i class="fa fa-sort"></i></th>
                        <th>Details <i class="fa fa-sort"></i></th>
                        <th>Assigned <i class="fa fa-sort"></i></th>
                        <th>Status <i class="fa fa-sort"></i></th>
                    </tr>
                </thead>
                <tbody class="list">
                @foreach($issues as $issue)
                    @if(!$issue->hidden || Auth::user()->rank <= 2)
                        <tr>
                            <td class="select"><input class="issue-checkbox" type="checkbox" onchange="checkSelected()" value="{{ $issue->id }}"></td>
                            <td class="reference">{{{ $issue->reference }}}</td>
                            <td class="details">
                                <span class="summary"><a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}/issues/show/{{{ $issue->id }}}">{{ $issue->summary }}</a></span>
                                <span class="description">{{{ substr($issue->description,0,80) }}}...</span>
                                <span class="details"><i class="fa fa-calendar"></i> {{ date("d M Y",strtotime($issue->created_at)) }} <i class="fa fa-diamond"></i> {{ $issue->version }} @if(Auth::user()->rank < 3) @if($issue->claimed_by) <i class="fa fa-user"></i> {{ $issue->claimed_by->name }} @endif  @if($issue->hidden) <i class="fa fa-eye-slash"></i> Hidden from client @endif @endif</span>
                            </td>
                            <td class="assigned">
                                @if($issue->assigned() == 'Client') {{{ $issue->project->client->name }}} @else {{{ $issue->assigned() }}} @endif
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
        @include('_components.tableactions')
        <script>
            var options = { valueNames: ['reference', 'details', 'assigned', 'status'] };
            var userList = new List('issues', options);
        </script>
    </div>
    </body>
@stop
