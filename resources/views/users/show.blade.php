@extends('layout.base')
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<a href="/users"><li> Users</li></a>
<li class="current">{{{ $user->name }}}</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>{{{ $user->name }}}</h1>
        <a class="action" href="/users/edit/{{{ $user->id }}}"><i class="fa fa-edit"></i> Edit user</a>
        <a class="action" href="/users/delete/{{ $user->id }}"><i class="fa fa-exclamation-circle"></i> Delete client</a>
        <h2>Full name</h2>
        <p>{{{ $user->name }}}</p>
        <h2>Email address</h2>
        <p>{{{ $user->email }}}</p>
        <h2>Groups</h2>
            <ul class="standard">
            @foreach($user->groups()->get() as $group)
                <li>{{{ $user->name }}}</li>
            @endforeach
            </ul>
    </div>
</body>
@stop
