@extends('_layout.base')
@section('headlinks')

@stop
@section('crumbtrail')
<a href="/"><li><i class="fa fa-home"></i> Home</li></a>
<a href=""><li class="current">Help</li></a>
@stop
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main" class="help">
        @include('_layout.header')
        <h1>Help</h1>
        <p>Hi! We're still in the early stages of this help guide. If your question isn't answered here, please send me an email to <a href="mailto:hello@jamie.sh">hello&#64;jamie.sh</a> and I will get back to you as soon as possible with an answer.</p>
        <section>
            <h2>Viewing issues</h2>
            <p>To get a list of issues, you can simply navigate to the main project page via the navigation pane on the left. Selecting 'View issues' will bring you to a list of issues for the current version of the project. For example, if a project is currently at version 2, this page will display all of the issues logged for that version only. If you would like to see issues for other versions, issues assigned to you, or a full list of all of the issues in the system, you can use the filter button at the top.</p>
        </section>
        <section>
            <h2>Logging an issue</h2>
            <p>The main point of the application is to log your issues, amendments and changes to your project, so the team can get to work on making your elearning project perfect. Luckily, logging an issue is incredibly simple. From the left hand navigation pane you should first select <strong>Projects</strong> which will take you to a list of projects you have access to. Selecting your project brings you to the project homepage, with some quick information about it. You can log an issue directly from this page by clicking the 'Log an issue' button at the top in red, or from the overall 'View issues' page in the same place.</p>
        </section>
        <section>
            <h2>Updating an issue</h2>
            <p>There are a number of ways to update an issue once it has been created. Firstly, you'll need to be viewing the issue by selecting it from the list of available issues. From this display you can perform a number of actions. If you'd like to add some extra information about an issue, or send a message to the team working on it, you can simply enter a comment in the large comment area. You can also add attachments such as pictures or documents from this area. If you feel the issue needs assigning to a different group of users, you can select this from the dropdown box. Finally, if you're happy the issue has been completed and wish to send it for QA, you can mark it as resolved.</p>
        </section>
        <section>
            <h2>Closing an issue</h2>
            <p>We've opted for a very simple issue process. An issue gets created, is worked on by the team and then resolved, and finally it is closed off by the client when you're happy it has been completed successfully. When an issue is set to 'Resolved' (usually by the development team), you won't be able to add anything new to the issue as it will be in review mode. You'll have been sent a link by the Project Manager when the project is available for review, and should go through the issue list that you created ensuring that all of the issues have been completed - they will have been QA'd by our development team, but we want to make sure you're happy with them before we continue. Doing this is easy, as when the issue is resolved by developers, you have a 'Close issue' button at the top available to you. As you can imagine, clicking this will close the issue, and we will consider it complete!</p>
        </section>
        <section>
            <h2>Changing your password</h2>
            <p>Changing your password from the one that was given to you is available through your personal account settings. To get there, just click on 'Account' on the left navigation pane, and select the red 'Edit details' button at the top. You'll need to enter your old password, and then the new password you would like twice. Please make a note of your password as you can only change it by contacting us if you forget it.</p>
        </section>
    </div>

</body>
@stop
