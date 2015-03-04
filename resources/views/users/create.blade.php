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
                    <a href="/users">Users</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/users/create">Create user</a>
                </div>
            @endif
            <h1>Create user</h1>
        </header>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label>Full name</label>
            <input value="{{ old('name') }}" name="name" type="text" placeholder="e.g. John Smith" autofocus @if($errors->has('name')) class="error">
            <span class="error">{{ $errors->first('name') }}</span> @else > @endif

            <label>Email address</label>
            <input value="{{ old('email') }}" name="email" type="text" placeholder="e.g. john.smith&#64;gmail.com" @if($errors->has('email')) class="error">
            <span class="error">{{ $errors->first('email') }}</span> @else > @endif

            <label>Client</label>
            <select name="client_id">
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>

            <label>Rank</label>
            <input type="radio" name="rank" value="1"> Admin
            <input type="radio" name="rank" value="2"> Employee
            <input type="radio" name="rank" value="3" checked> Client
            @if($errors->has('type'))
                <span class="error">{{ $errors->first('type') }}</span> @endif

            <label>Password (<a onclick="generatePassword()" style="cursor:pointer">Generate</a>)</label>
            <input value="{{ old('password') }}" id="password" name="password" type="text" placeholder="e.g. qwerty1" @if($errors->has('password')) class="error">
            <span class="error">{{ $errors->first('password') }}</span> @else > @endif

            <div id="assign_groups">
                <label>Assign groups</label>
                <input name="spongeuk_project_management" type="checkbox"> Sponge UK (Project Management)<br/>
                <input name="spongeuk_development" type="checkbox"> Sponge UK (Development) <br/>
                <input name="spongeuk_visual_design" type="checkbox"> Sponge UK (Visual Design) <br/>
                <input name="spongeuk_instructional_design" type="checkbox"> Sponge UK (Instructional Design) <br/>
            </div>

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Create user</button>
        </form>
    </div>
@stop
