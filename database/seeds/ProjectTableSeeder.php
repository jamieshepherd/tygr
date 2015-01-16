<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Project;

class ProjectTableSeeder extends Seeder {

    public function run()
    {

        Project::create(array(
            'name'    => 'On the Job',
            'stub'    => 'onthejob',
            'client'  => 1
        ));

        Project::create(array(
            'name'    => 'Sales and Service',
            'stub'    => 'salesandservice',
            'client'  => 1
        ));

        Project::create(array(
            'name'    => 'Introduction to Sports Direct',
            'stub'    => 'introtosportsdirect',
            'client'  => 1
        ));

        Project::create(array(
            'name'    => 'Session 1',
            'stub'    => 'session1',
            'client'  => 2
        ));

        Project::create(array(
            'name'    => 'Session 2',
            'stub'    => 'session2',
            'client'  => 2
        ));

        Project::create(array(
            'name'    => 'Session 3',
            'stub'    => 'session3',
            'client'  => 2
        ));

        Project::create(array(
            'name'    => 'Session 4',
            'stub'    => 'session4',
            'client'  => 2
        ));
    }

}
