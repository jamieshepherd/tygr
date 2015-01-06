<!DOCTYPE html>
<html>
<head>
    <title>Sponge UK Issue Tracking Prototype</title>
    <script>
        (function(d) {
            var config = {
                    kitId: 'wud4ymu',
                    scriptTimeout: 3000
                },
                h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='//use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
        })(document);
    </script>
    {{ HTML::style( asset('assets/css/base.css') ) }}
    {{ HTML::style( asset('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css') ) }}
</head>
<body>
    <nav>
        <img class="sponge-logo" src="assets/images/sponge-logo.svg">
        <ul>
            <li><i class="fa fa-desktop"></i>Dashboard</li>
            <li><i class="fa fa-user"></i>Clients</li>
            <li><i class="fa fa-rocket"></i>Projects</li>
            <li><i class="fa fa-bug"></i>Issues</li>
        </ul>
    </nav>
    <div id="main">
        <header>
            <ul class="crumbtrail">
                <li><i class="fa fa-bug"></i> Issues</li>
                <li>Sports Direct</li>
                <li>On the Job</li>
                <li class="current">All issues</li>
            </ul>
            <span class="account">
                <i class="fa fa-lock"></i> Account
            </span>
        </header>
        <h1>All issues</h1>
        <input class="filter" type="text" placeholder="Filter issues">
        <a class="action" href="#"><i class="fa fa-plus-circle"></i> New issue</a>
        <a class="action" href="#"><i class="fa fa-bug"></i> All issues</a>
        <a class="action" href="#"><i class="fa fa-bug"></i> Assigned to me</a>
        <table class="full">
            <tr>
                <th>Ref.</th>
                <th>Type</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>b-05</td>
                <td>Text amend</td>
                <td>Could we please change the intro text to read something else lorem ipsum dolor sit amet...</td>
                <td>14/03/15</td>
                <td class="priority high">Open</td>
            </tr>
            <tr>
                <td>b-05</td>
                <td>Text amend</td>
                <td>Could we please change the intro text to re...</td>
                <td>14/03/15</td>
                <td class="priority high">Open</td>
            </tr>
            <tr>
                <td>b-15</td>
                <td>Bug fix</td>
                <td>There is an error when opening the narrative...</td>
                <td>15/03/15</td>
                <td class="priority medium">Open</td>
            </tr>
            <tr>
                <td>b-15</td>
                <td>Bug fix</td>
                <td>There is an error when opening the narrative...</td>
                <td>15/03/15</td>
                <td class="priority medium">Open</td>
            </tr>
            <tr>
                <td>b-15</td>
                <td>Bug fix</td>
                <td>There is an error when opening the narrative...</td>
                <td>15/03/15</td>
                <td class="priority medium">Open</td>
            </tr>
            <tr>
                <td>b-15</td>
                <td>Bug fix</td>
                <td>There is an error when opening the narrative...</td>
                <td>15/03/15</td>
                <td class="priority medium">Open</td>
            </tr>
            <tr>
                <td>b-15</td>
                <td>Bug fix</td>
                <td>There is an error when opening the narrative...</td>
                <td>15/03/15</td>
                <td class="priority medium">Open</td>
            </tr>
            <tr>
                <td>b-25</td>
                <td>Text amend</td>
                <td>Could we please change the intro text to re...</td>
                <td>16/03/15</td>
                <td class="priority low">Open</td>
            </tr>
            <tr>
                <td>b-25</td>
                <td>Text amend</td>
                <td>Could we please change the intro text to re...</td>
                <td>16/03/15</td>
                <td class="priority low">Pending</td>
            </tr>
            <tr>
                <td>b-05</td>
                <td>Text amend</td>
                <td>Could we please change the intro text to re...</td>
                <td>14/03/15</td>
                <td class="priority low">Pending</td>
            </tr>
            <tr class="resolved">
                <td>b-15</td>
                <td>Bug fix</td>
                <td>There is an error when opening the narrative...</td>
                <td>15/03/15</td>
                <td class="priority low">Resolved</td>
            </tr>
            <tr class="resolved">
                <td>b-25</td>
                <td>Text amend</td>
                <td>Could we please change the intro text to re...</td>
                <td>16/03/15</td>
                <td class="priority low">Resolved</td>
            </tr>
        </table>
    </div>
</body>
</html>
