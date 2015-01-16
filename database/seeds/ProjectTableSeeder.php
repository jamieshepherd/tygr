<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Project;

class ProjectTableSeeder extends Seeder {

    public function run()
    {

        Project::create(array(
            'name'            => 'On the Job',
            'stub'            => 'onthejob',
            'client_id'          => 2,
            'project_manager_id' => 2,
            'lead_developer_id'  => 1,
            'lead_designer_id'   => 3,
            'current_version' => 'v1'
        ));

        Project::create(array(
            'name'    => 'Sales and Service',
            'stub'    => 'salesandservice',
            'client_id'  => 2,
            'project_manager_id' => 2,
            'lead_developer_id'  => 1,
            'lead_designer_id'   => 3,
            'current_version' => 'v1'
        ));

        Project::create(array(
            'name'    => 'Introduction to Sports Direct',
            'stub'    => 'introtosportsdirect',
            'client_id'  => 2,
            'project_manager_id' => 2,
            'lead_developer_id'  => 1,
            'lead_designer_id'   => 3,
            'current_version' => 'v1'
        ));

        Project::create(array(
            'name'    => 'Session 1',
            'stub'    => 'session1',
            'client_id'  => 3,
            'project_manager_id' => 2,
            'lead_developer_id'  => 1,
            'lead_designer_id'   => 3,
            'current_version' => 'v1'
        ));

        Project::create(array(
            'name'    => 'Session 2',
            'stub'    => 'session2',
            'client_id'  => 3,
            'project_manager_id' => 2,
            'lead_developer_id'  => 1,
            'lead_designer_id'   => 3,
            'current_version' => 'v1'
        ));

        Project::create(array(
            'name'    => 'Session 3',
            'stub'    => 'session3',
            'client_id'  => 3,
            'project_manager_id' => 2,
            'lead_developer_id'  => 1,
            'lead_designer_id'   => 3,
            'current_version' => 'v1'
        ));

        Project::create(array(
            'name'    => 'Session 4',
            'stub'    => 'session4',
            'client_id'  => 3,
            'project_manager_id' => 2,
            'lead_developer_id'  => 1,
            'lead_designer_id'   => 3,
            'current_version' => 'v1'
        ));
    }

}
