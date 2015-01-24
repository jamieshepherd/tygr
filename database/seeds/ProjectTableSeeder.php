<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Project;

class ProjectTableSeeder extends Seeder {

    public function run()
    {

        Project::create(array(
            'name'                   => 'On the Job',
            'stub'                   => 'onthejob',
            'client_id'              => 2,
            'project_manager'        => 'Andrea Kinsman',
            'lead_developer'         => 'Jamie Shepherd',
            'lead_designer'          => 'Alex Stewart',
            'instructional_designer' => 'Rhea Stevens',
            'current_version'        => 'Version 1',
            'authoring_tool'         => 'Adapt',
            'lms_deployment'         => 'Client',
            'lms_specification'      => 'SCORM 1.2',
            'status'                 => 'In development'
        ));

        Project::create(array(
            'name'                   => 'Sales and Service',
            'stub'                   => 'salesandservice',
            'client_id'              => 2,
            'project_manager'        => 'Andrea Kinsman',
            'lead_developer'         => 'Jamie Shepherd',
            'lead_designer'          => 'Alex Stewart',
            'instructional_designer' => 'Rhea Stevens',
            'current_version'        => 'Version 1',
            'authoring_tool'         => 'Adapt',
            'lms_deployment'         => 'Client',
            'lms_specification'      => 'SCORM 1.2',
            'status'                 => 'In development'
        ));

        Project::create(array(
            'name'                   => 'Introduction to Sports Direct',
            'stub'                   => 'introtosportsdirect',
            'client_id'              => 2,
            'project_manager'        => 'Andrea Kinsman',
            'lead_developer'         => 'Jamie Shepherd',
            'lead_designer'          => 'Alex Stewart',
            'instructional_designer' => 'Rhea Stevens',
            'current_version'        => 'Version 1',
            'authoring_tool'         => 'Adapt',
            'lms_deployment'         => 'Client',
            'lms_specification'      => 'SCORM 1.2',
            'status'                 => 'In development'
        ));

        Project::create(array(
            'name'                   => 'Session 1',
            'stub'                   => 'session1',
            'client_id'              => 3,
            'project_manager'        => 'Andrea Kinsman',
            'lead_developer'         => 'Jamie Shepherd',
            'lead_designer'          => 'Alex Stewart',
            'instructional_designer' => 'Rhea Stevens',
            'current_version'        => 'Version 1',
            'authoring_tool'         => 'Adapt',
            'lms_deployment'         => 'Client',
            'lms_specification'      => 'SCORM 1.2',
            'status'                 => 'In development'
        ));

        Project::create(array(
            'name'                   => 'Session 2',
            'stub'                   => 'session2',
            'client_id'              => 3,
            'project_manager'        => 'Andrea Kinsman',
            'lead_developer'         => 'Jamie Shepherd',
            'lead_designer'          => 'Alex Stewart',
            'instructional_designer' => 'Rhea Stevens',
            'current_version'        => 'Version 1',
            'authoring_tool'         => 'Adapt',
            'lms_deployment'         => 'Client',
            'lms_specification'      => 'SCORM 1.2',
            'status'                 => 'In development'
        ));

        Project::create(array(
            'name'                   => 'Session 3',
            'stub'                   => 'session3',
            'client_id'              => 3,
            'project_manager'        => 'Andrea Kinsman',
            'lead_developer'         => 'Jamie Shepherd',
            'lead_designer'          => 'Alex Stewart',
            'instructional_designer' => 'Rhea Stevens',
            'current_version'        => 'Version 1',
            'authoring_tool'         => 'Adapt',
            'lms_deployment'         => 'Client',
            'lms_specification'      => 'SCORM 1.2',
            'status'                 => 'In development'
        ));

        Project::create(array(
            'name'                   => 'Session 4',
            'stub'                   => 'session4',
            'client_id'              => 3,
            'project_manager'        => 'Andrea Kinsman',
            'lead_developer'         => 'Jamie Shepherd',
            'lead_designer'          => 'Alex Stewart',
            'instructional_designer' => 'Rhea Stevens',
            'current_version'        => 'Version 1',
            'authoring_tool'         => 'Adapt',
            'lms_deployment'         => 'Client',
            'lms_specification'      => 'SCORM 1.2',
            'status'                 => 'In development'
        ));
    }

}
