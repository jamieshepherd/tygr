@extends('layout.base')
@section('body')
    <body>
    @include('layout.nav')
    <div id="main">
        <header>
            <ul class="crumbtrail">
                <li><i class="fa fa-bug"></i> Issues</li>
                <li>Sports Direct</li>
                <li>On the Job</li>
                <li class="current">All issues</li>
            </ul>
            <ul class="account">
                <a href="#"><li><i class="fa fa-lock"></i> Account</li></a>
                <a href="/auth/logout"><li><i class="fa fa-sign-out"></i> Sign out</li></a>
            </ul>
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
@stop