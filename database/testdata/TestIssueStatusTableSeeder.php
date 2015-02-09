<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\IssueStatus;

class TestIssueStatusTableSeeder extends Seeder {

    public function run()
    {

        IssueStatus::create(array(
            'name' => 'New',
        ));

        IssueStatus::create(array(
            'name' => 'Assigned',
        ));

        IssueStatus::create(array(
            'name' => 'Awaiting client',
        ));

        IssueStatus::create(array(
            'name' => 'Resolved',
        ));

        IssueStatus::create(array(
            'name' => 'Closed',
        ));

    }

}
