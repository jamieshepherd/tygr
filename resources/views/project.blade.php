@extends('layout.base')
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        <header>
            <ul class="crumbtrail">
                <a href="/"><li><i class="fa fa-home"></i> Home</li></a>
                <a href="/projects"><li>Projects</li></a>
                <a href=""><li class="current">{{{ $project->name }}}</li></a>
            </ul>
            <ul class="account">
                <a href="/account"><li><i class="fa fa-lock"></i> Account</li></a>
                <a href="/auth/logout"><li><i class="fa fa-sign-out"></i> Sign out</li></a>
            </ul>
        </header>
        <h1>{{{ $project->name }}}</h1>
        <!--a class="action" href="/posts/create"><i class="fa fa-plus-circle"></i> New post</a-->
        <a class="action" href="{{ Request::url() }}/issues"><i class="fa fa-bug"></i> View issues</a>
        <a class="action" href="{{ Request::url() }}/review/"><i class="fa fa-desktop"></i> Review area</a>
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
        <h2>Welcome to your project</h2>
        <p>This is the main homepage for the project <strong>{{{ $project->name }}}</strong>. From here you can create or view amends with the issues button, or see the latest module links on your project Review Area.</p>
        <h2>Help, I have a problem!</h2>
        <p>Your project manager is listed to the right. You can contact this PM for any issues you come across or need if you need help throughout the duration of this project.</p>
    </div>
</body>
@stop