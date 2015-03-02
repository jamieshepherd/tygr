@extends('_layout.base')
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<a href="/users"><li> Users</li></a>
<li class="current">{{{ $user->name }}}</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>{{{ $user->name }}}</h1>
        <a class="action" href="/users/edit/{{{ $user->id }}}"><i class="fa fa-edit"></i> Edit user</a>
        <a class="action" href="/users/delete/{{ $user->id }}"><i class="fa fa-exclamation-circle"></i> Delete user</a>
        <h2>Full name</h2>
        <p>{{{ $user->name }}}</p>
        <h2>Email address</h2>
        <p>{{{ $user->email }}}</p>
        <h2>Groups</h2>
            <ul class="standard">
            @foreach($user->groups as $group)
                <li>{{{ $group->name }}}</li>
            @endforeach
            </ul>
        <h2>Rank</h2>
        <p>@if($user->rank == 1) Admin @elseif($user->rank == 2) Employee @else Client @endif</p>
    </div>
@stop
