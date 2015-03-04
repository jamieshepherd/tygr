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
                    <a href="/account">Account</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/account/edit">Edit account</a>
                </div>
            @endif
            <h1>Edit account</h1>
        </header>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label>Client name</label>
            <input name="name" type="text" placeholder="e.g. John Smith" autofocus value="{{{ Auth::user()->name }}}">
             @if($errors->has('name'))
                <span class="error">{{ $errors->first('name') }}</span>
            @endif

            <label>Email address</label>
            <input name="email" type="text" placeholder="e.g. john.smith&#64;gmail.com" value="{{{ Auth::user()->email }}}">
            @if($errors->has('email'))
                <span class="error">{{ $errors->first('email') }}</span>
            @endif

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
@stop
