@extends('layout.base')
@section('headlinks')
    <script src="/js/helpers.js"></script>
@stop
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/users"><li>Users</li></a>
    <li class="current">Create</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>Create user</h1>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label>Client name</label>
            <input name="name" type="text" placeholder="e.g. John Smith" value="{{{ $user->name }}}" autofocus>

            <label>Email address</label>
            <input name="email" type="text" placeholder="e.g. john.smith&#64;gmail.com" value="{{{ $user->email }}}">

            <label>Client</label>
            <input name="client" type="text" placeholder="e.g. 1" value="{{{ $user->client_id }}}">

            <label>Rank</label>
            <input name="rank" type="text" placeholder="e.g. 1" value="{{{ $user->rank }}}">

            <label>Password (<a onclick="generatePassword()" style="cursor:pointer">Generate</a>)</label>
            <input id="password" name="password" type="text" placeholder="e.g. qwerty1">

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Create user</button>
        </form>

    </div>
    </body>
@stop