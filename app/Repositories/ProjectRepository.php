<?php namespace App\Repositories;

use App\Repositories\Contracts\ProjectRepositoryInterface;

use Auth;
use Hash;
use App\Group;
use App\Project;
use App\Issue;
use App\IssueHistory;
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
     * Find a specific project by stub
     *
     * @param  string  stub
     */
    public function findByStub($stub)
    {
        return Project::where('stub', '=', $stub)->first();
    }

    /*
     * Return the recent activity of a project
     *
     * @param  string  stub
     */
    public function recentActivity($id)
    {
        return IssueHistory::with('issue')
            ->where('project_id', '=', $id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
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
     * Update a project
     *
     * @param  string  $stub
     * @param  UpdateProjectRequest  $request
     */
    public function update($stub, UpdateProjectRequest $request)
    {
        $project = $this->findByStub($stub);
        if(!$project) abort(404);

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
     * Delete a user
     */
    public function delete($id) {
        return User::destroy($id);
    }

    /*
     * Return the recent activity of a project
     *
     * @param  string  stub
     * @return array
     */
    public function getStatistics($id)
    {
        $projectStats = array();

        $projectStats['openIssues'] = count(Issue::where('project_id', '=', $id)
                    ->where('status', '!=', 'Resolved')
                    ->where('status', '!=', 'Closed')
                    ->get()
            );

        $projectStats['resolvedIssues'] = count(Issue::where('project_id', '=', $id)
                ->where('status', '=', 'Resolved')
                ->orWhere('status', '=', 'Closed')
                ->get()
            );

        $projectStats['assignedToYou'] = count(Issue::whereIn('assigned_to_id', Auth::user()->groups->lists('id'))
                ->where('project_id', '=', $id)
                ->where('status','!=','Closed')
                ->get()
            );

        return $projectStats;
    }

    /*
     * Return all versions associated with a project
     */
    public function getVersions($id)
    {
        return Issue::where('project_id', '=', $id)->distinct()->select('version')->get();
    }

    /*
     * Return an amount of closed issues frmo a project
     */
    public function getClosed($id)
    {
        return Issue::where('project_id', '=', $id)->where('status','=','closed')->get();
    }


    /*
     * Change version
     *
     * @param  string  $stub
     * @param  float  $version
     */
    public function changeVersion($stub, $version)
    {
        $project = $this->findByStub($stub);
        $project->current_version = $version;

        return $project->save();
    }

    /*
     * Return all the possible user groups an issue can be assigned to
     */
    public function getGroups()
    {
        // Only get two groups if we're client, otherwise get all
        return (Auth::user()->rank == 3) ? Group::take(2)->get() : Group::all();
    }
}