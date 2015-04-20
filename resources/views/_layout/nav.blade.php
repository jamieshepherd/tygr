<nav id="nav" class="large">
    <img class="sponge-logo resizable" src="/images/sponge-logo.svg" onerror="this.src='/images/sponge-logo.png'; this.onerror=null;"/>
    <ul>
        @if(Auth::guest())
            <a href="/auth/login"><li><i class="fa fa-lock"></i><span class="resizable">Sign in</span></li></a>
        @else
            @if(Auth::user()->rank <= 2)
                <a href="/dashboard"><li><i class="fa fa-bar-chart"></i><span class="resizable">Dashboard</span></li></a>
                <a href="/clients"><li><i class="fa fa-user"></i><span class="resizable">Clients</span></li></a>
            @endif
            @if(Auth::user()->rank == 1)
                <a href="/users"><li><i class="fa fa-user-plus"></i><span class="resizable">Users</span></li></a>
            @endif
            @if(Auth::user()->rank == 3)
            <a href="/projects"><li><i class="fa fa-rocket"></i><span class="resizable">Projects</span></li></a>
            @endif
            <a href="/help"><li><i class="fa fa-question-circle"></i><span class="resizable">Help</span></li></a>
            <a href="/account"><li><i class="fa fa-lock"></i><span class="resizable">Account</span></li></a>
            @if(Auth::user()->rank == 1)
                <a href="/system"><li><i class="fa fa-cogs"></i><span class="resizable">System</span></li></a>
            @endif
            <!--a href="/auth/logout"><li><i class="fa fa-sign-out"></i><span class="resizable">Sign out</span></li></a-->
        @endif
    </ul>
    <div class="resizer" onClick="resizeNav()"></div>
</nav>
