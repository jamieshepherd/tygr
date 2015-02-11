@extends('_layout.base')

@section('body')
    <body class="printable">
        <h1>Issues printout @if(isset($filter)) <em>({{{ $filter }}})</em> @else <em>({{{ $project->current_version }}})</em>@endif</h1>
        <ul>
            <li>Client: {{ $project->client->name }}</li>
            <li>Project: {{ $project->name }}</li>
        </ul>
        <hr/>
            @foreach($issues as $issue)
            @if(!$issue->hidden || Auth::user()->rank <= 2)
            <h3>Type: {{ $issue->type }}, Reference: {{ $issue->reference }}</h3>
            <p>{{ $issue->description }}</p>
            <hr/>
            @endif
            @endforeach
</body>
@endsection
