<?php namespace App\Repositories;

use App\Repositories\Contracts\ProjectRepositoryInterface;

use Auth;
use Hash;
use App\Project;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectRepository implements ProjectRepositoryInterface {

    /*
     * Retrieve all projects
     *
     * @return  User
     */
    public function getAll()
    {
        return Project::all();
    }

    /*
     * Retrieve all projects for current user
     *
     * @return  User
     */
    public function getMyProjects()
    {
        return Project::where('client_id', '=', Auth::user()->client_id)->get();
    }

    /*
     * Find a specific user
     *
     * @param  int  $id
     *
     * @return  User
     */
    public function find($id)
    {
        return Project::find($id);
    }

    /*
     * Create a new user
     *
     * @param  CreateUserRequest $request
     */
    public function create($client, CreateProjectRequest $request)
    {
        $project = new Project();
        $project->client_id					 = $client->id;
        $project->hidden 					 = $request->has('hidden');
        $project->name				         = $request->name;
        $project->stub				         = $request->stub;
        $project->current_version	         = $request->current_version;
        $project->status			         = $request->status;
        $project->authoring_tool             = $request->authoring_tool;
        $project->lms_deployment             = $request->lms_deployment;
        $project->lms_specification          = $request->lms_specification;
        $project->project_manager   		 = $request->project_manager;
        $project->lead_developer    		 = $request->lead_developer;
        $project->lead_designer     		 = $request->lead_designer;
        $project->instructional_designer     = $request->instructional_designer;

        return $project->save();
    }

    /*
     * Update a user
     *
     * @param  int  $id
     * @param  UpdateUserRequest  $request
     */
    public function update($id, UpdateProjectRequest $request) {
        $user            = $this->find($id);
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->client_id = $request->client_id;
        $user->rank      = $request->rank;

        // If the password field is not empty, change the password
        if($request->input('password')) {
            $user->password = Hash::make($request->password);
        }

        $result = $user->save();

        // Set and unset groups for the user if needed
        if($request->has('spongeuk_project_management')) {
            if(!$user->belongsToGroup('Sponge UK (Project Management)')) {
                $user->attachToGroup('Sponge UK (Project Management)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Project Management)',$user->id);
        }

        if($request->has('spongeuk_development')) {
            if(!$user->belongsToGroup('Sponge UK (Development)')) {
                $user->attachToGroup('Sponge UK (Development)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Development)',$user->id);
        }

        if($request->has('spongeuk_visual_design')) {
            if(!$user->belongsToGroup('Sponge UK (Visual Design)')) {
                $user->attachToGroup('Sponge UK (Visual Design)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Visual Design)',$user->id);
        }

        if($request->has('spongeuk_instructional_design')) {
            if(!$user->belongsToGroup('Sponge UK (Instructional Design)')) {
                $user->attachToGroup('Sponge UK (Instructional Design)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Instructional Design)',$user->id);
        }

        if($request->has('spongeuk_launch_and_learn')) {
            if(!$user->belongsToGroup('Sponge UK (Launch & Learn)')) {
                $user->attachToGroup('Sponge UK (Launch & Learn)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Launch & Learn)',$user->id);
        }

        if($request->has('spongeuk_marketing')) {
            if(!$user->belongsToGroup('Sponge UK (Marketing)')) {
                $user->attachToGroup('Sponge UK (Marketing)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Marketing)',$user->id);
        }

        if($request->has('spongeuk_human_resources')) {
            if(!$user->belongsToGroup('Sponge UK (Human Resources)')) {
                $user->attachToGroup('Sponge UK (Human Resources)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Human Resources)',$user->id);
        }

        if($request->has('spongeuk_accounting')) {
            if(!$user->belongsToGroup('Sponge UK (Accounting)')) {
                $user->attachToGroup('Sponge UK (Accounting)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Accounting)',$user->id);
        }

        if($request->has('spongeuk_administration')) {
            if(!$user->belongsToGroup('Sponge UK (Administration)')) {
                $user->attachToGroup('Sponge UK (Administration)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Administration)',$user->id);
        }

        return $result;
    }

    /*
     * Delete a user
     */
    public function delete($id) {
        return User::destroy($id);
    }

}