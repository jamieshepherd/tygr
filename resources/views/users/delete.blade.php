@extends('_layout.base')
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
                    <a href="/account">Users</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/users/show/{{ $user->id }}">{{{ $user->name }}}</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/users/delete/{{ $user->id }}">Confirm delete</a>
                </div>
            @endif
            <h1>Confirmation</h1>
        </header>
        <h2>Are you absolutely sure?</h2>
        <p>This will permanently delete the user <strong>{{{ $user->name }}}</strong>, and all history associated with it.</p>
        <p>Are you absolutely sure you want to delete <strong>{{{ $user->name }}}</strong>?</p><br/>

        <a class="action" href="/users/delete/{{{ $user->id }}}?confirm=true"><i class="fa fa-exclamation-circle"></i> Yes, I'm sure</a>
        <a class="action red" href="/users/show/{{{ $user->id }}}"><i class="fa fa-arrow-circle-left"></i> No, take me back</a>
    </div>
@stop
