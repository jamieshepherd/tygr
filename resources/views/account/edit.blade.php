@extends('layout.base')
@section('crumbtrail')
    <a href="/account"><li><i class="fa fa-home"></i> Account</li></a>
    <li class="current">Edit</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>Edit account</h1>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label>Client name</label>
            <input name="name" type="text" placeholder="e.g. John Smith" autofocus value="{{{ Auth::user()->name }}}">

            <label>Email address</label>
            <input name="email" type="text" placeholder="e.g. john.smith&#64;gmail.com" value="{{{ Auth::user()->email }}}">

            <br/><br/><hr/>

            <h2>Change password</h2>

            <label>Old password</label>
            <input name="oldpass" type="password">

            <label>New password</label>
            <input name="newpass" type="password">

            <label>Confirm new password</label>
            <input name="confirmpass" type="password">
            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Update details</button>
        </form>

    </div>
    </body>
@stop