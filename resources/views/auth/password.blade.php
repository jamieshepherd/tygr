@extends('_layout.base')
@section('body')
<body class="photo" style="background: #222222 url(/images/login/background{{ rand(1,5) }}.png);">
<div class="gradient">
    <div class="login">
        <img class="sponge-logo" src="/images/sponge-logo-red.svg" onerror="this.src='/images/sponge-logo-red.png'; this.onerror=null;">
        <form action="/password/email" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="email">Email address</label>
            <input name="email" type="text" placeholder="Email address">
            <input type="submit" value="Send reset email">
            @if($errors->has()) <hr/><span class="error"><i class="fa fa-exclamation-triangle"></i> Check for any errors and try again</span>@endif
        </form>
    </div>
</div>
@stop
