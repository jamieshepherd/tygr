<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Project;

class ProjectTableSeeder extends Seeder {

    public function run()
    {

        Project::create(array(
            'name'                   => 'Fire Safety',
            'hidden'                 => false,
            'stub'                   => 'firesafety',
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
            'name'                   => 'Getting Started',
            'hidden'                 => false,
            'stub'                   => 'gettingstarted',
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
            'name'                   => 'Introduction to Blue Industries',
            'hidden'                 => false,
            'stub'                   => 'introtoblueindustries',
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
            'hidden'                 => false,
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
            'hidden'                 => false,
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
            'hidden'                 => false,
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
            'hidden'                 => false,
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
