<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Issue;

class IssueTableSeeder extends Seeder {

    public function run()
    {

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-01',
            'type'       => 'Bug fix',
            'status'     => 'New',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'High'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-06',
            'type'       => 'Bug fix',
            'status'     => 'New',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'High'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-02',
            'type'       => 'Bug fix',
            'status'     => 'New',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'High'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'New',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Medium'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'New',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Medium'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Assigned',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Assigned',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Assigned',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Assigned',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Resolved',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Resolved',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));

        Issue::create(array(
            'author_id'     => 1,
            'assigned_to_id'=> 2,
            'project_id'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Resolved',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'Low'
        ));
    }

}
