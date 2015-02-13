@extends('_layout.base')

@section('body')
    <body class="printable">
        <h2>Issues printout</h2>
        <ul>
            <li>Client: {{ $project->client->name }}</li>
            <li>Project: {{ $project->name }}</li>
        </ul>
        <hr/>
            @foreach($issues as $issue)
            @if(!$issue->hidden || Auth::user()->rank <= 2)
            <h3>{{ $issue->reference }} ({{ $issue->summary }})</h3>
            <p>{{ $issue->description }}</p>
            <hr/>
            @endif
            @endforeach
</body>
@endsection
