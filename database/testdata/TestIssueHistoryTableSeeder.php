<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\IssueHistory;

class TestIssueHistoryTableSeeder extends Seeder {

    public function run()
    {

        IssueHistory::create(array(
            'issue_id'   => 1,
            'author_id'  => 1,
            'type'       => 'status',
            'status'     => 'created',
            'comment'    => 'Issue was created'
        ));

        IssueHistory::create(array(
            'issue_id'   => 1,
            'author_id'  => 1,
            'type'       => 'status',
            'status'     => 'assigned',
            'comment'    => 'Issue was assigned to Tom Stembridge'
        ));

        IssueHistory::create(array(
            'issue_id'   => 1,
            'author_id'  => 4,
            'type'       => 'comment',
            'comment'    => 'What the hell, I do not want to work on this!'
        ));

        IssueHistory::create(array(
            'issue_id'   => 1,
            'author_id'  => 5,
            'type'       => 'status',
            'status'     => 'assigned',
            'comment'    => 'Issue was assigned to Jamie Shepherd'
        ));

        IssueHistory::create(array(
            'issue_id'   => 1,
            'author_id'  => 1,
            'type'       => 'comment',
            'comment'    => 'Fine, I have done the changes. Lazy bugger.'
        ));

        IssueHistory::create(array(
            'issue_id'   => 1,
            'author_id'  => 1,
            'type'       => 'status',
            'status'     => 'resolved',
            'comment'    => 'Issue was changed to resolved'
        ));
    }

}
