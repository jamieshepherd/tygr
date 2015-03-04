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
                    <a href="/users/edit/{{ $user->id }}">Edit user</a>
                </div>
            @endif
            <h1>Edit user</h1>
        </header>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label>Full name</label>
            <input name="name" type="text" placeholder="e.g. John Smith" value="{{{ $user->name }}}" autofocus @if($errors->has('name')) class="error">
            <span class="error">{{ $errors->first('name') }}</span> @else > @endif

            <label>Email address</label>
            <input name="email" type="text" placeholder="e.g. john.smith&#64;gmail.com" value="{{{ $user->email }}}" @if($errors->has('email')) class="error">
            <span class="error">{{ $errors->first('email') }}</span> @else > @endif

            <label>Client</label>
            <select name="client_id">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" @if($client->id == $user->client_id) selected @endif >{{ $client->name }}</option>
                @endforeach
            </select>

            <label>Rank</label>
            <input type="radio" name="rank" value="1" @if($user->rank==1) checked @endif> Admin
            <input type="radio" name="rank" value="2" @if($user->rank==2) checked @endif> Employee
            <input type="radio" name="rank" value="3" @if($user->rank==3) checked @endif> Client
            @if($errors->has('rank'))
                <span class="error">{{ $errors->first('rank') }}</span> @endif

            <label>Password (<a onclick="generatePassword()" style="cursor:pointer">Generate</a>)</label>
            <input id="password" name="password" type="text" placeholder="e.g. qwerty1" @if($errors->has('password')) class="error">
            <span class="error">{{ $errors->first('password') }}</span> @else > @endif

            <div id="assign_groups">
                <label>Assign groups</label>
                <input name="spongeuk_project_management" type="checkbox" @if($user->belongsToGroup('Sponge UK (Project Management)')) checked @endif> Sponge UK (Project Management)<br/>
                <input name="spongeuk_development" type="checkbox" @if($user->belongsToGroup('Sponge UK (Development)')) checked @endif> Sponge UK (Development) <br/>
                <input name="spongeuk_visual_design" type="checkbox" @if($user->belongsToGroup('Sponge UK (Visual Design)')) checked @endif> Sponge UK (Visual Design) <br/>
                <input name="spongeuk_instructional_design" type="checkbox" @if($user->belongsToGroup('Sponge UK (Instructional Design)')) checked @endif> Sponge UK (Instructional Design) <br/>
            </div>

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Save changes</button>
        </form>
    </div>
@stop
