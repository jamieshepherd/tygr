@extends('_layout.base')
@section('headlinks')
    <script src="/js/list.min.js"></script>
    <script src="/js/sortable.min.js"></script>
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
                    <a href="/projects">Projects</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/projects/{{ $project->client->stub }}/{{ $project->stub }}">{{ $project->name }}</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/projects/{{ $project->client->stub }}/{{ $project->stub }}/issues">Amendments</a>
                </div>
            @endif
                <h1>Amendments <em class="filter">({{ $_GET['filter'] or $project->current_version }})</em></h1>
        </header>
        <div id="issues">
            <input class="filter search" placeholder="Search" autofocus/>
            <a class="action" href="/projects/{{ $project->client->stub }}/{{ $project->stub }}/issues/create"><i class="fa fa-plus-circle"></i> New amendment</a>
            <span class="action yellow button-dropdown">
                <i class="fa fa-chevron-circle-down"></i> Filter
                <ul>
                    <li>
                        <a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}/issues?filter=all">
                            <i class="fa fa-angle-right"></i> All amendments
                        </a>
                    </li>
                    <li>
                        <a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}/issues?filter=me">
                            <i class="fa fa-angle-right"></i> Assigned to me
                        </a>
                    </li>
                    @foreach($versions as $version)
                    <li>
                        <a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}/issues?filter={{ $version->version }}">
                            <i class="fa fa-angle-right"></i> {{ $version->version }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </span>
            <a class="action blue" href="{{ Request::url() }}/print?filter=({{ $_GET['filter'] or $project->current_version }})"><i class="fa fa-print"></i> Print</a>
            <!--a class="action" href=""><i class="fa fa-bug"></i> All issues</a-->


            <table class="full" data-sortable>
                <thead>
                    <tr class="head">
                        <th class="select" data-sortable="false" data-sorted="false"><input type="checkbox" onchange="selectAll(this)"></th>
                        <th>Date <i class="fa fa-sort"></i></th>
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
                            <td class="date"><i class="fa fa-calendar"></i> &nbsp;{{ date("d M Y",strtotime($issue->created_at)) }}</td>
                            <td class="reference">{{{ $issue->reference }}}</td>
                            <td class="details">
                                <span class="summary"><a href="/projects/{{ $project->client->stub }}/{{{ $project->stub }}}/issues/show/{{{ $issue->id }}}">{{ $issue->summary }}</a></span>
                                <span class="description">{{{ substr($issue->description,0,80) }}}...</span>
                                <span class="details"><i class="fa fa-flask" title="Project version"></i> {{ $issue->version }} @if(Auth::user()->rank < 3) @if($issue->claimed_by) <i class="fa fa-thumb-tack" title="Claimed by"></i> {{ $issue->claimed_by->name }} @endif  @if($issue->hidden) <i class="fa fa-eye-slash" title="Hidden from client"></i> Hidden from client @endif @endif</span>
                            </td>
                            <td class="assigned">
                                @if($issue->assigned() == 'Client') {{{ $issue->project->client->name }}} @else {{{ $issue->assigned() }}} @endif
                            </td>
                            <td class="status">
                                {{{ $issue->status }}}
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
@stop
