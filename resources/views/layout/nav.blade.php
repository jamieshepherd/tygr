<nav>
    <img class="sponge-logo" src="/images/sponge-logo.svg">
    <ul>
        @if(Auth::user()->client == null)
            <a href="/dashboard"><li><i class="fa fa-desktop"></i>Dashboard</li></a>
            <a href="/clients"><li><i class="fa fa-user"></i>Clients</li></a>
        @else
            <a href="/projects"><li><i class="fa fa-rocket"></i>Projects</li></a>
        @endif
            <!--li><i class="fa fa-rocket"></i>Projects</li>
            <li><i class="fa fa-bug"></i>Issues</li-->

        <a href="/account"><li><i class="fa fa-lock"></i>Account</li></a>
        <a href="/auth/logout"><li><i class="fa fa-sign-out"></i>Sign out</li></a>
    </ul>
</nav>