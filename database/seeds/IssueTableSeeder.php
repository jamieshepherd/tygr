<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Issue;

class IssueTableSeeder extends Seeder {

    public function run()
    {

        Issue::create(array(
            'author'     => 1,
            'version'    => 'v1',
            'reference'  => 'b-01',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> 'Lorem ipsum dolor sit amet'
        ));

        Issue::create(array(
            'author'     => 1,
            'version'    => 'v1',
            'reference'  => 'b-06',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> 'Lorem ipsum dolor sit amet'
        ));

        Issue::create(array(
            'author'     => 1,
            'version'    => 'v1',
            'reference'  => 'b-02',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> 'Lorem ipsum dolor sit amet'
        ));

        Issue::create(array(
            'author'     => 1,
            'version'    => 'v1',
            'reference'  => 'b-03',
            'type'       => 'Bug fix',
            'status'     => 'Open',
            'description'=> 'Lorem ipsum dolor sit amet'
        ));
    }

}