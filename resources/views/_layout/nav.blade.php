<nav id="nav" class="large">
    <img class="sponge-logo resizable" src="/images/sponge-logo.svg">
    <ul>
        @if(Auth::user()->rank <= 2)
            <a href="/dashboard"><li><i class="fa fa-desktop"></i><span class="resizable">Dashboard</span></li></a>
            <a href="/clients"><li><i class="fa fa-user"></i><span class="resizable">Clients</span></li></a>
        @endif
        @if(Auth::user()->rank == 1)
            <a href="/users"><li><i class="fa fa-users"></i><span class="resizable">Users</span></li></a>
        @endif
        <a href="/projects"><li><i class="fa fa-rocket"></i><span class="resizable">Projects</span></li></a>
        <a href="/account"><li><i class="fa fa-lock"></i><span class="resizable">Account</span></li></a>
        <a href="/auth/logout"><li><i class="fa fa-sign-out"></i><span class="resizable">Sign out</span></li></a>
    </ul>
    <div class="resizer" onClick="resizeNav()"></div>
</nav>