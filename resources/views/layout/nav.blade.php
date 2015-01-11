<nav>
    <img class="sponge-logo" src="/images/sponge-logo.svg">
    <ul>
        <!--li><i class="fa fa-desktop"></i>Dashboard</li>
        <li><i class="fa fa-user"></i>Clients</li>
        <li><i class="fa fa-rocket"></i>Projects</li>
        <li><i class="fa fa-bug"></i>Issues</li-->
        <a href="/clients/{{{ $client->stub }}}"><li><i class="fa fa-rocket"></i>Projects</li></a>
        <hr/>
        <a href="/account"><li><i class="fa fa-lock"></i>Account</li></a>
        <a href="/auth/logout"><li><i class="fa fa-sign-out"></i>Sign out</li></a>
    </ul>
</nav>