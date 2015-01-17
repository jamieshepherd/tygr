@extends('layout.base')
@section('crumbtrail')
    <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
    <a href="/clients"><li>Clients</li></a>
    <li class="current">Create</li>
@stop
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        @include('layout.header')
        <h1>Edit <em>{{{ $client->name }}}</em></h1>
        <form action="" method="POST" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            <label>Client type</label>
            <input type="radio" name="type" value="Client" @if($client->type == 'Client') checked @endif> Client
            <input type="radio" name="type" value="Pitch" @if($client->type == 'Pitch') checked @endif> Pitch

            <label>Client name</label>
            <input name="name" type="text" placeholder="e.g. Sponge UK" autofocus value="{{{ $client->name }}}">

            <label>Client stub<em>(Used for URLs)</em></label>
            <input name="stub" type="text" placeholder="e.g. spongeuk" value="{{{ $client->stub }}}">

            <br/><button type="submit"><i class="fa fa-arrow-circle-right"></i> Update details</button>
        </form>

    </div>
    </body>
@stop