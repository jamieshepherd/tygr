@extends('layout.base')
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Account</li></a>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>Account</h1>
        <a class="action" href="/account/edit"><i class="fa fa-edit"></i> Edit details</a>
        <h2>Full name</h2>
        <p>{{{ Auth::user()->name }}}</p>
        <h2>Email address</h2>
        <p>{{{ Auth::user()->email }}}</p>
        @if(Auth::user()->client_id != 3)
            <h2>Groups</h2>
            <ul class="standard">
            @foreach(Auth::user()->groups()->get() as $group)
                <li>{{{ $group->name }}}</li>
            @endforeach
            </ul>
        @endif
    </div>
</body>
@stop
