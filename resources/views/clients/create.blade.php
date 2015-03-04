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
                    <a href="/clients">Create</a>
                </div>
            @endif
            <h1>Create a client</h1>
        </header>
        <form action="{{{ Request::url() }}}" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label>Client type</label>
            <input type="radio" name="type" value="Client" checked> Client
            <input type="radio" name="type" value="Pitch"> Pitch
            @if($errors->has('type'))
            <span class="error">{{ $errors->first('type') }}</span> @endif

            <label>Client name</label>
            <input value="{{ old('name') }}" id="name" name="name" type="text" placeholder="e.g. Sponge UK" onkeyup="generateStub()" autofocus @if($errors->has('name')) class="error">
            <span class="error">{{ $errors->first('name') }}</span> @else > @endif

            <label>Client stub<em>(Used for URLs)</em></label>
            <input value="{{ old('stub') }}"id="stub" name="stub" type="text" placeholder="e.g. spongeuk" @if($errors->has('stub')) class="error">
            <span class="error">{{ $errors->first('stub') }}</span> @else > @endif

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Create client</button>
            <a class="action secondary" href="javascript:history.back()"><i class="fa fa-times-circle"></i> Cancel</a>
        </form>

    </div>
@stop
