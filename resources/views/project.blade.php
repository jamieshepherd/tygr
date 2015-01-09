@extends('layout.base')
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        <header>
            <ul class="crumbtrail">
                <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
                <a href="/clients/{{{ $client->stub }}}"><li>{{{ $client->name }}}</li></a>
                <a href="#"><li class="current">{{{ $project->name }}}</li></a>
            </ul>
            <ul class="account">
                <a href="/account"><li><i class="fa fa-lock"></i> Account</li></a>
                <a href="/auth/logout"><li><i class="fa fa-sign-out"></i> Sign out</li></a>
            </ul>
        </header>
        <h1>{{{ $project->name }}}</h1>
        <a class="action" href="/posts/create"><i class="fa fa-plus-circle"></i> New post</a>
        <a class="action" href="/clients/{{{ $client->stub }}}/projects/{{{ $project->stub }}}/issues"><i class="fa fa-bug"></i> View issues</a>
        <a class="action" href="review/"><i class="fa fa-desktop"></i> Review area</a>
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
    </div>
</body>
@stop