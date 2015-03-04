@extends('_layout.base')
@section('body')
    <body>
    @include('_layout.nav')
    <div id="main" class="help">
        <header>
            @if(Auth::user())
                <a class="signout action nofill green" href="/auth/logout"><i class="fa fa-sign-out"></i> Sign out</a>
                <div class="crumbtrail">
                    <a href="/">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <a href="/help">Help</a>
                </div>
            @endif
            <h1>Help</h1>
        </header>
        <p>Hi! We're still in the early stages of this help guide. If your question isn't answered here, please send me an email to <a href="mailto:jamie.shepherd@spongeuk.com">jamie.shepherd&#64;spongeuk.com</a> and I will get back to you as soon as possible.</p>
        <section>
            <h2>Why we use this application</h2>
            <p>The main purpose of this web-based system is to collate and log any of your issues, amendments and changes related to your project, so the team can get to work on making your elearning project perfect.</p>
            <p>You can submit your changes at any time, anywhere, simplifying the entire review phase.</p>
            <p>We've opted for a very simple issue process. An issue is created by you, this is then worked on by the team and then resolved, and finally you'll close off any issues when you're happy that the desired task has been completed successfully.</p>
        </section>
        <section>
            <h2>Supported internet browsers</h2>
            <p>While we would like the system to be as accessible as possible, in order to deliver the best functionality we can't officially support every browser. The system will be usuable in most (if not all) browsers, but might not work 100% as expected if your current browser isn't in the supported list. This list includes: </p>
            <ul>
                <li>Internet Explorer (7/8/9/10/11+)</li>
                <li>Google Chrome</li>
                <li>Mozilla Firefox</li>
                <li>Safari</li>
            </ul>
        </section>
         <section>
            <h2>Locating a project</h2>
            <p>From the left hand navigation pane you should first select <strong>Projects</strong> which will take you to a list of projects you have access to. Selecting a project will take you to the project homepage, here you will find a brief project overview. From here you can, log issues, view issues and navigate to Review Area.</p>
        </section>
        <section>
            <h2>Logging an issue</h2>
            <p>From your project page you can log an issue by clicking the red 'Log an issue' button located towards the top of the screen. In addition to this, the same button is also available from the 'View issues' page.</p>
        </section>
        <section>
            <h2>Viewing issues</h2>
            <p>To view a list of issues, navigate to your project page, Selecting 'View issues' will bring you to a list of issues for the current version of the project. For example, if a project is currently at version 2, this page will display all of the issues logged for that version only. If you would like to see issues for other versions, issues assigned to you, or a full list of all of the issues in the system, you can use the 'filter issues' button at the top.</p>
        </section>
        <section>
            <h2>Updating an issue</h2>
            <p>There are a number of ways to update an issue once it has been created. Firstly, you'll need to be viewing the issue by selecting it from the list of available issues. From this page you can perform a number of actions. If you'd like to add some extra information about an issue, or send a message to the team working on it, you can simply enter a comment in the large comment area. You can also add attachments such as pictures or documents from this area. Be sure to click the "Update issue" button at the bottom of the page to save any changes.</p>
        </section>
        <section>
            <h2>Closing an issue</h2>
            <p>When an issue has been set to 'Resolved', you won't be able to add anything new to the issue as it will be in review mode.</p>
            <p>You'll have been sent a link by your Project Manager when the project is available for review. After launching your project you will need to work your way through the issue list ensuring that all of the issues have been completed to your requirements - they will have been QA'd by our us, but we want to make sure you're happy with them before we continue.</p>
            <p>Doing this is easy. When the issue is resolved by us, you have a 'Close issue' button at the top available to you. Clicking this will close the issue, and we will consider it complete!</p>
        </section>
        <section>
            <h2>Changing your password</h2>
            <p>Changing your password from the auto-generated password that was send to you in your welcome email is available through your personal account settings. To get there, just click on 'Account' on the left navigation pane, and select the red 'Edit details' button at the top. You'll need to enter your old password, and then the new password you would like twice. Please make a note of your password as you can only change it by contacting us if you forget it.</p>
        </section>
    </div>
@stop
