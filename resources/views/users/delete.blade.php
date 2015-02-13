@extends('_layout.base')
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/users"><li>User</li></a>
    <a href="/users/show/{{ $user->id }}"><li>{{{ $user->name }}}</li></a>
    <li class="current">Confirm delete</li>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main">
        @include('_layout.header')
        <h1>Are you absolutely sure?</h1>
        <p>This will permanently delete the user <strong>{{{ $user->name }}}</strong>, and all history associated with it.</p>
        <p>Are you absolutely sure you want to delete <strong>{{{ $user->name }}}</strong>?</p><br/>

        <a class="action" href="/users/delete/{{{ $user->id }}}?confirm=true"><i class="fa fa-exclamation-circle"></i> Yes, I'm sure</a>
        <a class="action secondary" href="/users/show/{{{ $user->id }}}"><i class="fa fa-arrow-circle-left"></i> No, take me back</a>
    </div>
    </body>
@stop
