<?php namespace App\Http\Controllers;

use App\Repositories\Contracts\IssueRepositoryInterface;
use App\Repositories\Contracts\ProjectRepositoryInterface;

use App\Http\Requests\CreateIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Http\Requests\UpdateIssueHistoryRequest;
use App\Commands\AddAttachmentCommand;
use App\Commands\DestroyAttachmentCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Input;
use Auth;
use DB;

class IssueController extends Controller {

    protected $issues;
    protected $projects;

    /**
     * Construct the controller with projects repository
     *
     * @param IssueRepositoryInterface $issues
     * @param ProjectRepositoryInterface $projects
     */
    public function __construct(IssueRepositoryInterface $issues, ProjectRepositoryInterface $projects) {
        $this->issues   = $issues;
        $this->projects = $projects;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $client;
	 * @param  string  $stub;
	 * @return Response
	 */
	public function index($client, $stub)
	{
        $project  = $this->projects->findByStub($stub);

        if(isset($_GET['filter'])) {
            $issues = $this->issues->getAll($project, $_GET['filter']);
        } else {
            $issues =  $this->issues->getAll($project, null);
        }

        $versions = $this->projects->getVersions($project->id);
        $title   = $project->name.' Amendments';

		return view('issues.index')->with(compact('title', 'project', 'issues', 'versions'));
	}

	/**
	 * Display a printable listing of the resource.
	 *
	 * @param  string  $client;
	 * @param  string  $stub;
	 * @param  string  $filter;
	 * @return Response
	 */
	public function printout($client, $stub, $filter = null)
	{
        $project  = $this->projects->findByStub($stub);

        if(isset($_GET['filter'])) {
            $issues = $this->issues->getAll($project, $_GET['filter']);
        } else {
            $issues =  $this->issues->getAll($project, null);
        }

		return view('issues.printout')->with(compact('project', 'issues', 'filter'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  string  $client;
	 * @param  string  $stub;
	 * @return Response
	 */
	public function create($client, $stub)
	{
		$project = $this->projects->findByStub($stub);
        if(!$project) abort(404);

		return view("issues.create")->with(compact('project'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateIssueRequest $request
	 * @param  string $client ;
	 * @param  string $stub ;
	 * @return Response
	 */
	public function store($client, $stub, CreateIssueRequest $request)
	{
		$project = $this->projects->findByStub($stub);
        $result  = $this->issues->create($project, $request);

        if($result) {
            session()->flash('tip', 'projects/'.$client.'/'.$stub.'/issues/show/'.$result);
            session()->flash('message', 'Your amendment was created successfully.');
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
	 * @param  string  $client
	 * @param  string  $stub
	 * @param  int  $id
	 * @return Response
	 */
	public function show($client, $stub, $id)
	{
		$issue = $this->issues->find($id);
        if(!$issue) abort(404);

		// Get all of the versions for this project
		$versions = $this->projects->getVersions($issue->project->id);
        $groups   = $this->projects->getGroups();
        $title = $issue->summary;

		return view('issues.show')->with(compact('title', 'issue', 'versions', 'groups'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $client
	 * @param  string  $stub
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($client, $stub, $id)
	{
		$issue = $this->issues->find($id);

		return view('issues.edit')->with(compact('issue'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  string $client
	 * @param  string $stub
	 * @param  int $id
	 * @param UpdateIssueRequest $request
	 * @return Response
	 */
	public function update($client, $stub, $id, UpdateIssueRequest $request)
	{
        //$project = $this->projects->findByStub($stub);
        $result = $this->issues->update($id, $request);

        if($result) {
            session()->flash('message', 'The amendment was updated.');
            return redirect('/projects/'.$client.'/'.$stub.'/issues/show/'.$id);
        } else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
        }
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  string $client
     * @param  string $stub
     * @param  int $id
     * @param  UpdateIssueHistoryRequest $request
     * @return Response
     */
	public function updateIssueHistory($client, $stub, $id, UpdateIssueHistoryRequest $request)
	{
		$result = $this->issues->updateIssueHistory($id, $request);

        if($result) {
            session()->flash('message', 'The amendment was updated.');
            return redirect('/projects/'.$client.'/'.$stub.'/issues/show/'.$id);
        } else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
        }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  string  $client
	 * @param  string  $stub
	 * @param  string  $idlist
	 * @return Response
	 */
	public function delete($client, $stub, $idlist)
	{
		if(isset($_GET['confirm']) && $_GET['confirm'] == true) {
            $result = $this->issues->delete($idlist);

            if($result) {
                session()->flash('message', 'The amendment(s) were deleted.');
                return redirect('/projects/'.$client.'/'.$stub.'/issues');
            } else {
                session()->flash('notify-type', 'error');
                session()->flash('message', 'This was unsuccessful, please try again.');
                return redirect()->back();
            }
		}

		return view ('issues.delete')->with('idlist', $idlist);
	}

	/**
	 * Set an issue's status to resolved.
	 *
	 * @param  string  $client
	 * @param  string  $stub
	 * @param  int  $id
	 * @return Response
	 */
	public function resolve($client, $stub, $id)
	{
        $result = $this->issues->resolve($id);

        if($result) {
            session()->flash('message', 'The amendment was updated.');
            return redirect('/projects/'.$client.'/'.$stub.'/issues/show/'.$id);
        } else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
        }
	}

	/**
	 * Set an issue's status to resolved.
	 *
	 * @param  string  $client
	 * @param  string  $stub
	 * @param  int  $id
	 * @return Response
	 */
	public function close($client, $stub, $id)
	{
        $result = $this->issues->close($id);

        if($result) {
            session()->flash('message', 'The amendment was marked as closed.');
            return redirect('/projects/'.$client.'/'.$stub.'/issues');
        } else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
        }
	}

	/**
	 * Set an issue's status to resolved.
	 *
	 * @param  string  $client
	 * @param  string  $stub
	 * @param  int  $id
	 * @return Response
	 */
	public function reopen($client, $stub, $id)
	{
        $result = $this->issues->reopen($id);

        if($result) {
            session()->flash('message', 'The amendment was reopened.');
            return redirect('projects/'.$client.'/'.$stub.'/issues/show/'.$id);
        } else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
        }
	}

	/**
	 * Claim an issue or multiple issues
	 *
	 * @param  string  $client
	 * @param  string  $stub
	 * @param  string  $idlist
	 * @return Response
	 */
	public function claim($client, $stub, $idlist)
	{
        $result = $this->issues->claim($idlist);

        if($result) {
            session()->flash('message', 'The amendment(s) were set claimed.');
            return redirect()->back();
        } else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
        }
	}


    /**
     * Claim an issue or multiple issues
     *
     * @param  string  $client
     * @param  string  $stub
     * @param  string  $idlist
     * @return Response
     */
    public function assign($client, $stub, $idlist)
    {
        if(isset($_GET['group'])) {
			$result = $this->issues->assign($idlist, $_GET['group']);

            if($result) {
                session()->flash('message', 'The issue(s) were assigned successfully.');
                return redirect()->back();
            } else {
                session()->flash('notify-type', 'error');
                session()->flash('message', 'This was unsuccessful, please try again.');
                return redirect()->back();
            }
        }
        abort(403);
    }

	/**
     * Move issue(s) to a different version
     *
     * @param  string  $client
     * @param  string  $stub
     * @param  string  $idlist
     * @return Response
     */
    public function changeVersion($client, $stub, $idlist)
    {
        if(isset($_GET['version'])) {
            $result = $this->issues->changeVersion($idlist, $_GET['version']);

            if($result) {
                session()->flash('message', 'Issue version set to: '.$_GET['version']);
                return redirect()->back();
            } else {
                session()->flash('notify-type', 'error');
                session()->flash('message', 'This was unsuccessful, please try again.');
                return redirect()->back();
            }
        }
        abort(403);
    }

}
