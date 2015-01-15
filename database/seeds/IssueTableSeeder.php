<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Issue;

class IssueTableSeeder extends Seeder {

    public function run()
    {

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-01',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'high'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-06',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'high'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-02',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'high'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'medium'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'medium'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'low'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'low'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'low'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'low'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'low'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'low'
        ));

        Issue::create(array(
            'author'     => 1,
            'assigned_to'=> 1,
            'project'    => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> file_get_contents('http://loripsum.net/api/1/short/plaintext'),
            'priority'   => 'low'
        ));
    }

}