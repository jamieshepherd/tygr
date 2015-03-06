<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\ClientRepositoryInterface;

use App\Http\Requests;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\NewVersionRequest;

use App\Client;
use App\Project;
use App\User;
use App\Group;
use App\Issue;
use App\IssueHistory;
use Auth;
use Input;
use Session;

class ProjectController extends Controller {

    protected $projects;
    protected $clients;

    /**
     * Construct the controller with projects repository
     *
     * @param ProjectRepositoryInterface $projects
     * @param ClientRepositoryInterface $clients
     */
    public function __construct(ProjectRepositoryInterface $projects, ClientRepositoryInterface $clients) {
        $this->projects = $projects;
        $this->clients  = $clients;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Auth::user()->rank == 3) {
            $projects = $this->projects->getMyProjects();
            return view('projects.index')->with(compact('projects'));
        } else {
            return redirect('/clients');
        }
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  string  $stub
	 * @return Response
	 */
	public function create($stub)
	{
		$client = $this->clients->findByStub($stub);
		return view('projects.create')->with(compact('client'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param string $stub
	 * @param CreateProjectRequest $request
	 * @return Response
	 */
	public function store($stub, CreateProjectRequest $request)
	{
		$client = $this->clients->findByStub($stub);
        $result = $this->projects->create($client, $request);

        if($result) {
            session()->flash('message', $request->name.' was created successfully.');
            return redirect()->back();
        } else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
        }
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $client
	 * @param  string  $stub
	 * @return Response
	 */
	public function show($client, $stub)
	{
		$client = Client::where('stub', '=', $client)->first();
		if(!$client) abort(404);

		$project = Project::where('client_id', '=', $client->id)
			->where('stub', '=', $stub)->first();
		if(!$project) abort(404);

        $issues = Issue::where('project_id', '=', $project->id)
            ->get();

        $issueHistory = IssueHistory::with('issue')
            ->where('project_id', '=', $project->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

		$userGroups = Auth::user()->groups->lists('id');

        $projectStats = array();

        $projectStats['openIssues'] =
            count(
                Issue::where('project_id', '=', $project->id)
                    ->where('status', '!=', 'Resolved')
                    ->where('status', '!=', 'Closed')
                    ->get()
            );

        $projectStats['resolvedIssues'] =
            count(Issue::where('project_id', '=', $project->id)
                    ->where('status', '=', 'Resolved')
                    ->orWhere('status', '=', 'Closed')
                    ->get()
            );

        $projectStats['assignedToYou'] =
            count(Issue::whereIn('assigned_to_id', $userGroups)
                ->where('project_id', '=', $project->id)
                ->where('status','!=','Closed')
                ->get()
            );

		return view('projects.show')->with('project', $project)
            ->with('issues', $issues)
            ->with('issueHistory', $issueHistory)
            ->with('projectStats', $projectStats);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $client
	 * @param  string  $stub
	 * @return Response
	 */
	public function edit($client, $stub)
	{
		$client = Client::where('stub', '=', $client)->first();
		if(!$client) abort(404);

		$project = Project::where('client_id', '=', $client->id)
			->where('stub', '=', $stub)->first();
		if(!$project) abort(404);

		return view('projects.edit')->with('project', $project);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  string $client
	 * @param  string $stub
	 * @param UpdateProjectRequest $request
	 * @return Response
	 */
	public function update($client, $stub, UpdateProjectRequest $request)
	{
		$client = Client::where('stub', '=', $client)->first();
		if(!$client) abort(404);

		$project = Project::where('client_id', '=', $client->id)
			->where('stub', '=', $stub)->first();
		if(!$project) abort(404);

		$project->hidden 					 = Input::has('hidden');
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
		$result = $project->save();

		if($result) {
			Session::flash('message', 'Project details updated successfully.');
			return redirect('/projects/'.$project->client->stub.'/'.$project->stub);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    /**
     * Show the form for moving a project to a new version.
     *
     * @param  string  $client
     * @param  string  $stub
     * @return Response
     */
    public function version($client, $stub)
    {
        $client = Client::where('stub', '=', $client)->first();
        if(!$client) abort(404);

        $project = Project::where('client_id', '=', $client->id)
            ->where('stub', '=', $stub)->first();
        if(!$project) abort(404);

        return view('projects.version')->with('project', $project);
    }

    /**
     * Perform moving the project to a new version.
     *
     * @param  string  $client
     * @param  string  $stub
     * @param  NewVersionRequest  $request
     * @return Response
     */
    public function newVersion($client, $stub, NewVersionRequest $request)
    {
        $client = Client::where('stub', '=', $client)->first();
        if(!$client) abort(404);

        $project = Project::where('client_id', '=', $client->id)
            ->where('stub', '=', $stub)->first();
        if(!$project) abort(404);

        $project->current_version	         = $request->new_version;
        $result = $project->save();

        if($result) {
            Session::flash('message', 'Project moved to version '.$request->current_version.'.');
            return redirect('/projects/'.$project->client->stub.'/'.$project->stub);
        }

        return view('projects.version')->with('project', $project);
    }

}
