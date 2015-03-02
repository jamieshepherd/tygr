@extends('_layout.base')
@section('body')
<body class="photo" style="background: #222222 url(/images/login/background{{ rand(1,5) }}.png);">
<div class="gradient">
    <div class="login">
        <img class="sponge-logo" src="/images/sponge-logo-red.svg" onerror="this.src='/images/sponge-logo-red.png'; this.onerror=null;">
        <form action="/password/reset" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="{{ $token }}">
            <label for="email">Email address</label>
            <input name="email" type="text" placeholder="Email address">
            <label for="password">New password</label>
            <input name="password" type="password" placeholder="New password">
            <label for="password_confirmation">Confirm password</label>
            <input name="password_confirmation" type="password" placeholder="Confirm password">
            <input type="submit" value="Reset password">
            @if($errors->has()) <hr/><span class="error"><i class="fa fa-exclamation-triangle"></i>There were some problems, check the form and try again</span>@endif
        </form>
    </div>
</div>
</body>
</html>
@stop
