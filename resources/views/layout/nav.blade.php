<nav>
    <img class="sponge-logo" src="/images/sponge-logo.svg">
    <ul>
        @if(Auth::user()->rank <= 2)
            <a href="/dashboard"><li><i class="fa fa-desktop"></i>Dashboard</li></a>
            <a href="/clients"><li><i class="fa fa-user"></i>Clients</li></a>
        @endif
        @if(Auth::user()->rank == 1)
            <a href="/users"><li><i class="fa fa-users"></i>Users</li></a>
        @endif
        <a href="/projects"><li><i class="fa fa-rocket"></i>Projects</li></a>
        <a href="/account"><li><i class="fa fa-lock"></i>Account</li></a>
        <a href="/auth/logout"><li><i class="fa fa-sign-out"></i>Sign out</li></a>
    </ul>
</nav>