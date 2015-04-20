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
                    <a href="/system">System</a>
                </div>
            @endif
            <h1>System settings</h1>
        </header>
        <div class="tip">
            <i class="fa fa-info-circle"></i> This is a critical settings area. <strong>Do not</strong> make changes here unless you know exactly what you are doing.
        </div>
        <!--a class="action yellow" href="/account/edit"><i class="fa fa-edit"></i> Edit details</a-->
        <h2 class="no-margin-top">Composer update</h2>
        <p>Run a composer update. This should be run at off-peak times as it often uses a large amount of PHP memory, making requests and PHP processing slower.</p>
        <a class="action red" href="/system/run/composer-update"><i class="fa fa-exclamation-triangle"></i> Run composer update</a>

    </div>
@stop
