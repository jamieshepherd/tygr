<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Issue;

class TestIssueTableSeeder extends Seeder {

    public function run()
    {

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-01',
            'type'       => 'Bug fix',
            'status_id'     => 1,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'High'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-06',
            'type'       => 'Bug fix',
            'status_id'     => 1,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'High'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-02',
            'type'       => 'Bug fix',
            'status_id'     => 1,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'High'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status_id'     => 1,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Medium'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status_id'     => 1,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Medium'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status_id'     => 2,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status_id'     => 2,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status_id'     => 2,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status_id'     => 2,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status_id'     => 4,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status_id'     => 4,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'hidden'                 => false,
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'Version 1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status_id'     => 4,
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));
    }

}
