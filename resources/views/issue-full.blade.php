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
    <link media="all" type="text/css" rel="stylesheet" href="/css/base.css">
    <link media="all" type="text/css" rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
</head>
<body>
    <nav>
        <img class="sponge-logo" src="/images/sponge-logo.svg">
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
                <li class="current">Issue &#35;{{ $id }}</li>
            </ul>
            <span class="account">
                <i class="fa fa-lock"></i> Account
            </span>
        </header>
        <h1>Issue &#35;{{ $id }}</h1>
        <h2>Description</h2>
        <div class="info-box">
            <table>
                <tr><td><strong>Assigned to</strong></td><td>Jamie Shepherd</td></tr>
                <tr><td><strong>Reference</strong></td><td>b-05</td></tr>
                <tr><td><strong>Issue type</strong></td><td>Bug fix</td></tr>
                <tr><td><strong>Author</strong></td><td>John Smith</td></tr>
                <tr><td><strong>Date</strong></td><td>14th March 2015</td></tr>
                <tr><td><strong>Status</strong></td><td>Open</td></tr>
                <tr><td><strong>Priority</strong></td><td><i class="fa fa-exclamation-circle"></i> High</td></tr>
            </table>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam cumque delectus deserunt labore laudantium magnam maxime mollitia nihil, nostrum quod sequi, soluta suscipit. Assumenda dolorum itaque, nam officia quam reiciendis. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet blanditiis cum doloribus enim, error est et id laboriosam magni minus recusandae reiciendis repellat repudiandae rerum similique sunt ut, voluptatem.</p>
        <h2>Screenshots</h2>
        <img src="http://placehold.it/300x200">
        <img src="http://placehold.it/300x200">
        <h2>Comments</h2>
        <p>There are no comments.</p>
        <textarea placeholder="Enter a comment here"></textarea><br/>
        <a class="action" href="#"><i class="fa fa-arrow-circle-right"></i> Post comment</a>
    </div>
</body>
</html>
