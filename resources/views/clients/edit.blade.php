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
                    <a href="/clients">Clients</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/clients/show/{{ $client->stub }}">{{ $client->name }}</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/clients/edit/{{ $client->id }}">Edit client</a>
                </div>
            @endif
            <h1>Edit client</h1>
        </header>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label>Client type</label>
            <input type="radio" name="type" value="Client" @if($client->type == 'Client') checked @endif> Client
            <input type="radio" name="type" value="Pitch" @if($client->type == 'Pitch') checked @endif> Pitch
            @if($errors->has('type'))<span class="error">{{ $errors->first('type') }}</span> @endif

            <label>Client name</label>
            <input id="name" name="name" type="text" placeholder="e.g. Sponge UK" onkeyup="generateStub()" autofocus value="{{{ $client->name }}}" @if($errors->has('name')) class="error">
            <span class="error">{{ $errors->first('name') }}</span> @else > @endif

            <label>Client stub<em>(Used for URLs)</em></label>
            <input id="stub" name="stub" type="text" placeholder="e.g. spongeuk" value="{{{ $client->stub }}}" @if($errors->has('stub')) class="error">
            <span class="error">{{ $errors->first('stub') }}</span> @else > @endif

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Update details</button>
            <a class="action red" href="javascript:history.back()"><i class="fa fa-times-circle"></i> Cancel</a>
        </form>
    </div>
@stop
