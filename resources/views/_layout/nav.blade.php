<nav>
    <img class="sponge-logo" src="/images/sponge-logo.svg">
    <ul>
        @if(Auth::user()->rank <= 2)
            <a href="/dashboard"><li><i class="fa fa-desktop"></i><span>Dashboard</span></li></a>
            <a href="/clients"><li><i class="fa fa-user"></i><span>Clients</span></li></a>
        @endif
        @if(Auth::user()->rank == 1)
            <a href="/users"><li><i class="fa fa-users"></i><span>Users</span></li></a>
        @endif
        <a href="/projects"><li><i class="fa fa-rocket"></i><span>Projects</span></li></a>
        <a href="/account"><li><i class="fa fa-lock"></i><span>Account</span></li></a>
        <a href="/auth/logout"><li><i class="fa fa-sign-out"></i><span>Sign out</span></li></a>
    </ul>
</nav>