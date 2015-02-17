@extends('_layout.base')
@section('body')
<body class="photo" style="background: #222222 url(/images/login/background{{ rand(1,5) }}.png);">
<div class="gradient">
    <div class="login">
        <img class="sponge-logo" src="/images/sponge-logo-red.svg">
        <form action="/auth/login" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="email">Email address</label>
            <input name="email" type="text" placeholder="Email address">
            <label for="email">Password</label>
            <input name="password" type="password" placeholder="Password">
            <input name="remember" type="checkbox"><span class="remember">Remember me</span>
            <input type="submit" value="Sign in">
            @if($errors->has()) <hr/><span class="error"><i class="fa fa-exclamation-triangle"></i> The details you entered were incorrect</span>@endif
        </form>
    </div>
</div>
</body>
</html>
@stop
