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
            'name'    => 'Another Project',
            'stub'    => 'another',
            'client'  => 2
        ));
    }

}