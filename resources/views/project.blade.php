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
                <li class="current">On the Job</li>
            </ul>
            <span class="account">
                <i class="fa fa-lock"></i> Account
            </span>
        </header>
        <h1>On the Job</h1>
        <a class="action" href="#"><i class="fa fa-plus-circle"></i> New post</a>
        <a class="action" href="#"><i class="fa fa-bug"></i> View issues</a>
        <a class="action" href="#"><i class="fa fa-desktop"></i> Review area</a>
        <div class="info-box">
            <table>
                <tr><td><strong>Current version</strong></td><td>2.0</td></tr>
            </table>
            <hr/>
            <table>
                <tr><td><strong>Project manager</strong></td><td>Andrea Kinsman</td></tr>
                <tr><td><strong>Lead developer</strong></td><td>Jamie Shepherd</td></tr>
                <tr><td><strong>Lead designer</strong></td><td>Alex Stewart</td></tr>
            </table>
            <hr/>
            <table>
                <tr><td><strong>Authoring tool</strong></td><td>Adapt 1.2</td></tr>
                <tr><td><strong>LMS Deployment</strong></td><td>Launch &amp; Learn</td></tr>
                <tr><td><strong>Specification</strong></td><td>Scorm 2004</td></tr>
            </table>
        </div>
        <h2>News post</h2>
        <h3>14th Feb 2015 by <strong>Andrea Kinsman</strong></h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi porro qui voluptas! Adipisci dicta ea eum, ex facilis id illum neque omnis placeat quaerat quia sed voluptatibus? Eum, quae, saepe. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, iure, optio? Accusantium aliquam aspernatur aut dolore dolorum eveniet expedita inventore iusto, laudantium magni nobis, perferendis provident quae quis reprehenderit repudiandae.</p>
        <h2>News post</h2>
        <h3>11th Feb 2015 by <strong>Jamie Shepherd</strong></h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi porro qui voluptas! Adipisci dicta ea eum, ex facilis id illum neque omnis placeat quaerat quia sed voluptatibus? Eum, quae, saepe. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, iure, optio? Accusantium aliquam aspernatur aut dolore dolorum eveniet expedita inventore iusto, laudantium magni nobis, perferendis provident quae quis reprehenderit repudiandae.</p>
        <h2>News post</h2>
        <h3>19th Jan 2015 by <strong>Andrea Kinsman</strong></h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi porro qui voluptas! Adipisci dicta ea eum, ex facilis id illum neque omnis placeat quaerat quia sed voluptatibus? Eum, quae, saepe. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, iure, optio? Accusantium aliquam aspernatur aut dolore dolorum eveniet expedita inventore iusto, laudantium magni nobis, perferendis provident quae quis reprehenderit repudiandae.</p>
    </div>
</body>
</html>
