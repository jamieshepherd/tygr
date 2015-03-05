@extends('emails.template')
@section('title')
    Reset password confirmation
@stop
@section('body')

    <h1>Reset password confirmation</h1>

    <p><strong>Hi there, either you or someone else has requested a change of password for your the account matching this email address.</strong></p>

    <p>If this wasn't you, you can safely just ignore this email. Otherwise,  click here to reset your password:</p>

    <p><a href="{{ url('password/reset/'.$token) }}">{{ url('password/reset/'.$token) }}</a></p>

    <p><strong>- Sponge UK</strong></p>

@stop