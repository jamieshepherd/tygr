@extends('emails.template')
@section('title')
    Welcome to Sponge UK
@stop
@section('body')

    <h2>Welcome</h2>

    <p><strong>Hello {{ $name }}, you've been created as a user on the Sponge UK issue tracking system.</strong></p>

    <p>You can use this area to log any amendments, changes, or issues with your projects as they are developed.</p>

    <p>Your login details are as follows:</p>
    <ul>
        <li>Email address: {{ $email }}</li>
        <li>Password: {{ $password }}</li>
    </ul>

    <p>Please visit http://review.spongeuk.com to sign in.</p>

    <p><strong>- Sponge UK</strong></p>

@stop