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
    <link media="all" type="text/css" rel="stylesheet" href="/css/main.css">
    <link media="all" type="text/css" rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
</head>
<body>
    <nav class="login">
        <img class="sponge-logo" src="/images/sponge-logo.svg">
        <form>
            <label for="email">Email address</label>
            <input name="email" type="text" placeholder="Email address">
            <label for="email">Password</label>
            <input name="password" type="password" placeholder="Password">
            <input type="submit" value="Sign in">
            <span class="extra"><i class="fa fa-key"></i> Forgotten your password?</span>
        </form>
    </nav>
</body>
</html>
