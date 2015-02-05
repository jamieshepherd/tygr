@extends('_layout.base')
@section('body')
<body class="photo" style="background: url(/images/login/background{{ rand(1,1) }}.png);">
    <div class="login">
        <img class="sponge-logo" src="/images/sponge-logo-red.svg">
        <form action="/auth/login" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="email">Email address</label>
            <input name="email" type="text" placeholder="Email address" @if($errors->has('email')) class="error">
            <span class="error">{{ $errors->first('email') }}</span> @else > @endif
            <label for="email">Password</label>
            <input name="password" type="password" placeholder="Password">
            <input name="remember" type="checkbox"><span class="remember">Remember me</span>
            <input type="submit" value="Sign in">
        </form>
    </div>
</body>
</html>
@stop
