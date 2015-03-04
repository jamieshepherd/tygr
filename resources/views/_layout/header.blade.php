<header>
    @if(Auth::user())
        <div class="crumbtrail">
            @yield('crumbtrail')
        </div>
        <a class="signout action nofill green" href="/auth/logout"><i class="fa fa-sign-out"></i> Sign out</a>
    @endif
    {{ $title }}
</header>