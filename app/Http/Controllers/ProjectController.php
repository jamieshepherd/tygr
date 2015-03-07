<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\Contracts\ProjectRepositoryInterface;
use App\Repositories\Contracts\ClientRepositoryInterface;

use App\Http\Requests;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\NewVersionRequest;

use Auth;

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
        $project = $this->projects->findByStub($stub);
        if(!$project) abort(404);

		return view('projects.show')->with(compact('project'))
            ->with('issueHistory', $this->projects->recentActivity($project->id))
            ->with('projectStats', $this->projects->getStatistics($project->id));
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
		$project = $this->projects->findByStub($stub);
		if(!$project) abort(404);

		return view('projects.edit')->with(compact('project'));
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
        $result = $this->projects->update($stub, $request);

        if($result) {
            session()->flash('message', 'Project updated successfully.');
            return redirect('/projects/'.$client.'/'.$request->stub);
        } else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
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
        $project = $this->projects->findByStub($stub);
        if(!$project) abort(404);

        return view('projects.version')->with(compact('project', $project));
    }

    /**
     * Perform moving the project to a new version.
     *
     * @param  string  $client
     * @param  string  $stub
     * @param  NewVersionRequest  $request
     * @return Response
     */
    public function changeVersion($client, $stub, NewVersionRequest $request)
    {
        $result = $this->projects->changeVersion($stub, $request->new_version);

        if($result) {
            session()->flash('message', 'Project was moved to version '.$request->new_version.'.');
            return redirect()->back();
        } else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
        }
    }

}
