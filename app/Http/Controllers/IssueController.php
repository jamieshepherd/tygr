<?php namespace App\Http\Controllers;

use App\Repositories\Contracts\IssueRepositoryInterface;
use App\Repositories\Contracts\ProjectRepositoryInterface;

use App\Http\Requests\CreateIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Commands\AddAttachmentCommand;
use App\Commands\DestroyAttachmentCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\IssueHistory;
use App\IssueStatus;
use App\Project;
use App\Client;
use App\Issue;
use App\Group;
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
		// Retrieve the client
		$client = Client::where('stub', '=', $client)->first();
		if(!$client) abort(404);

		// Retrieve the project
		$project = Project::where('client_id', '=', $client->id)->where('stub', '=', $stub)->first();
		if(!$project) abort(404);

		// Get all of the versions for this project
		$versions = Issue::where('project_id', '=', $project->id)->distinct()->select('version')->get();

		// Check if the results should be filtered
		if(!isset($_GET['filter'])) {
			$issues = Issue::where('project_id','=',$project->id)
				->where('version', '=', $project->current_version)
				->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                            WHEN status = 'Assigned' THEN '2'
                                            WHEN status = 'Awaiting Client' THEN '3'
                                            WHEN status = 'Resolved' THEN '4'
                                            WHEN status = 'Closed' THEN '5'
                                        END"), 'ASC')
				->get();
		} else {
			$filter = $_GET['filter'];

			if($filter == 'me') {
				$userGroups = \Auth::User()->groups->lists('id');
				$issues = Issue::whereIn('assigned_to_id', $userGroups)
					->where('project_id','=',$project->id)
					->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                            WHEN status = 'Assigned' THEN '2'
                                            WHEN status = 'Awaiting Client' THEN '3'
                                            WHEN status = 'Resolved' THEN '4'
                                            WHEN status = 'Closed' THEN '5'
                                        END"), 'ASC')
					->get();
				$filter = 'Assigned to me';
			} elseif($filter == 'all') {
				$issues = Issue::where('project_id', '=', $project->id)
                    ->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                            WHEN status = 'Assigned' THEN '2'
                                            WHEN status = 'Awaiting Client' THEN '3'
                                            WHEN status = 'Resolved' THEN '4'
                                            WHEN status = 'Closed' THEN '5'
                                        END"), 'ASC')
                    ->get();
				$filter = 'All issues';
			}
			else {
				$issues = Issue::where('project_id','=',$project->id)
					->where('version', '=', $filter)
					->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                            WHEN status = 'Assigned' THEN '2'
                                            WHEN status = 'Awaiting Client' THEN '3'
                                            WHEN status = 'Resolved' THEN '4'
                                            WHEN status = 'Closed' THEN '5'
                                        END"), 'ASC')
					->get();
			}
			return view('issues.index')
				->with('project', $project)
				->with('issues', $issues)
				->with('filter', $filter)
				->with('versions', $versions);
		}

		return view('issues.index')->with('project', $project)->with('issues', $issues)->with('versions', $versions);
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
		$client = Client::where('stub', '=', $client)->first();
		if(!$client) abort(404);

		$project = Project::where('client_id', '=', $client->id)->where('stub', '=', $stub)->first();
		if(!$project) abort(404);

		if(isset($filter)) {
			if($filter == 'me') {
                $userGroups = \Auth::User()->groups->lists('id');
				$issues = Issue::whereIn('assigned_to_id', $userGroups)
					->where('project_id','=',$project->id)
					->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                            WHEN status = 'Assigned' THEN '2'
                                            WHEN status = 'Awaiting Client' THEN '3'
                                            WHEN status = 'Resolved' THEN '4'
                                            WHEN status = 'Closed' THEN '5'
                                        END"), 'ASC')
					->get();
				$filter = 'Assigned to me';
			} elseif($filter == 'all') {
				$issues = $project->issues;
				$filter = 'All issues';
			}
			else {
				$issues = Issue::where('project_id','=',$project->id)
					->where('version', '=', $filter)
					->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                            WHEN status = 'Assigned' THEN '2'
                                            WHEN status = 'Awaiting Client' THEN '3'
                                            WHEN status = 'Resolved' THEN '4'
                                            WHEN status = 'Closed' THEN '5'
                                        END"), 'ASC')
					->get();
			}
		} else {
			$issues = Issue::where('project_id','=',$project->id)
				->where('version', '=', $project->current_version)
				->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                            WHEN status = 'Assigned' THEN '2'
                                            WHEN status = 'Awaiting Client' THEN '3'
                                            WHEN status = 'Resolved' THEN '4'
                                            WHEN status = 'Closed' THEN '5'
                                        END"), 'ASC')
				->get();
		}

		return view('issues.printout')
			->with('project', $project)
			->with('issues', $issues)
			->with('filter', $filter);
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
        $result = $this->issues->create($project, $request);

        if($result) {
            session()->flash('tip', 'projects/'.$client.'/'.$stub.'/issues/show/'.$result);
            session()->flash('message', 'Your issue was created successfully.');
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
		$versions = Issue::where('project_id', '=', $issue->project->id)->distinct()->select('version')->get();

        // Only get two groups if we're client, otherwise get all
        $groups = (Auth::user()->rank == 3) ? Group::take(2)->get() : Group::all();

		return view('issues.show')
            ->with('issue', $issue)
			->with('versions', $versions)
            ->with('groups', $groups);
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
		$issue              = $this->issues->find($id);
		$issue->hidden 	    = $request->has('hidden');
		$issue->summary     = $request->summary;
		$issue->priority    = 'Medium';
		$issue->reference   = $request->reference;
		$issue->description = $request->description;
		$result             = $issue->save();

		if($result) {
			$update = new IssueHistory();
            $update->hidden     = false;
            $update->project_id = $issue->project->id;
			$update->issue_id   = $issue->id;
			$update->author_id  = $issue->author->id;
			$update->type		= 'status';
			$update->status     = 'updated';
			$update->comment    = 'Issue was edited';
			$update->save();

			\Session::flash('message', 'The issue was updated.');
			return redirect('projects/'.$client.'/'.$stub.'/issues/show/'.$issue->id);
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  string  $client
	 * @param  string  $stub
	 * @param  int  $id
	 * @return Response
	 */
	public function updateIssueHistory($client, $stub, $id)
	{
		$issue = $this->issues->find($id);

		if(Input::file('attachment')) {
			$attachment = Input::file('attachment');
			$file = array(
			    "filename"  => $attachment->getClientOriginalName(),
				"extension" => $attachment->getClientOriginalExtension(),
				"filetype"  => $attachment->getMimeType()
			);
			$attachment->move("uploads/tmp", $file['filename']);
			$this->dispatch(new AddAttachmentCommand($file, $issue->id, \Auth::user()->id));
		}

		if(Input::get('priority')) {
			$issue->priority = Input::get('priority');
			$issue->save();
		}

		if(Input::get('comment')) {
			$update = new IssueHistory();
            $update->project_id = $issue->project->id;
			$update->issue_id   = $issue->id;
            $update->hidden      = Input::has('hidden');
			$update->author_id  = \Auth::user()->id;
			$update->type		= 'comment';
			$update->comment    = Input::get('comment');
			$update->save();
		}

		if(Input::get('assigned_to') != $issue->assigned_to->id) {

			$issue->assigned_to_id = Input::get('assigned_to');
			$issue->save();
			$issue = Issue::find($id);

			$update = new IssueHistory();
            $update->hidden     = false;
            $update->project_id = $issue->project->id;
			$update->issue_id   = $issue->id;
			$update->author_id  = \Auth::user()->id;
			$update->type		= 'status';
			$update->status     = 'assigned';
			if($issue->assigned_to->name == 'Client') {
				$issue->status  = 'Awaiting Client';
				$issue->save();
				$update->comment    = 'Issue was assigned to '.$issue->project->client->name;
			} else {
                $issue->status = 'Assigned';
				$issue->save();
				$update->comment    = 'Issue was assigned to '.$issue->assigned_to->name;
			}
			$update->save();
		}

		if(Input::get('resolved')) {
            $assigned_to_id        = Group::where('name', '=', 'Client')->first()->id;
			$issue->status	       = 'Resolved';
            $issue->assigned_to_id = $assigned_to_id;
			$result                = $issue->save();

			if($result) {
				$update = new IssueHistory();
                $update->hidden     = false;
                $update->project_id = $issue->project->id;
				$update->issue_id = $issue->id;
				$update->author_id = \Auth::user()->id;
				$update->type = 'status';
				$update->status = 'resolved';
				$update->comment = 'Issue was changed to resolved';
				$update->save();

			}
		}

		\Session::flash('message', 'The issue was updated.');
		return redirect('projects/'.$client.'/'.$stub.'/issues/show/'.$issue->id);

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
			// Check if we have multiple IDs to destroy
			$idArray = explode(',', $idlist);
			foreach($idArray as $id) {
				$issue = Issue::find($id);
				$attachments = $issue->attachments()->get();
				foreach($attachments as $attachment) {
					$this->dispatch(new DestroyAttachmentCommand($attachment));
				}
				Issue::destroy($id);
			}

			\Session::flash('message', 'The issue(s) were removed successfully.');
			return redirect('projects/'.$client.'/'.$stub.'/issues');
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
		$issue                 = $this->issues->find($id);
        $assigned_to_id        = Group::where('name', '=', 'Client')->first()->id;
		$issue->status      = 'Resolved';
		$issue->assigned_to_id = $assigned_to_id;
		$result                = $issue->save();

		if($result) {
			$update            = new IssueHistory();
            $update->hidden    = false;
            $update->project_id = $issue->project->id;
			$update->issue_id  = $issue->id;
			$update->author_id = \Auth::user()->id;
			$update->type      = 'status';
			$update->status    = 'resolved';
			$update->comment   = 'Issue was changed to resolved';
			$update->save();

			\Session::flash('message', 'The issue was updated.');
			return redirect('projects/'.$client.'/'.$stub.'/issues/show/'.$issue->id);
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
		$issue = $this->issues->find($id);
		$issue->status = 'Closed';
		$result = $issue->save();

		if($result) {
			$update = new IssueHistory();
            $update->hidden     = false;
            $update->project_id = $issue->project->id;
			$update->issue_id = $issue->id;
			$update->author_id = \Auth::user()->id;
			$update->type = 'status';
			$update->status = 'closed';
			$update->comment = 'Issue was closed';
			$update->save();

			\Session::flash('message', 'The issue was closed.');
			return redirect('projects/'.$client.'/'.$stub.'/issues/show/'.$issue->id);
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
		$issue = $this->issues->find($id);
		$issue->status = 'Assigned';
		$result = $issue->save();

		if($result) {
			$update = new IssueHistory();
            $update->hidden     = false;
            $update->project_id = $issue->project->id;
			$update->issue_id = $issue->id;
			$update->author_id = \Auth::user()->id;
			$update->type = 'status';
			$update->status = 'reopened';
			$update->comment = 'Issue was reopened';
			$update->save();

			\Session::flash('message', 'The issue was updated.');
			return redirect('projects/'.$client.'/'.$stub.'/issues/show/'.$issue->id);
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
		// Check if we have multiple IDs to claim
		$idArray = explode(',', $idlist);
		foreach($idArray as $id) {
			$issue 				  = Issue::find($id);
			$issue->claimed_by_id = Auth::user()->id;
			$issue->save();
		}
		\Session::flash('message', 'Issue(s) claimed by '.Auth::user()->name);
		return redirect()->back();
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
			if($_GET['group'] == 'sponge') {
				$groupid = Group::where('name', '=', 'Sponge UK')->first()->id;
			} elseif($_GET['group'] == 'client') {
				$groupid = Group::where('name', '=', 'Client')->first()->id;
			} else {
				abort(403);
			}

			// Check if we have multiple IDs to assign
            $idArray = explode(',', $idlist);
            foreach($idArray as $id) {
				$issue                 = Issue::find($id);
	 			$issue->assigned_to_id = $groupid;
	            $issue->claimed_by_id  = Auth::user()->id;
	            $issue->save();
            }
			\Session::flash('message', 'Issue(s) assigned successfully.');
            return redirect()->back();
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
    public function reversion($client, $stub, $idlist)
    {
        if(isset($_GET['version'])) {
			$version = $_GET['version'];
			// Check if we have multiple IDs to assign
            $idArray = explode(',', $idlist);
            foreach($idArray as $id) {
				$issue                 = Issue::find($id);
	 			$issue->version        = $version;
	            $issue->save();
            }
			\Session::flash('message', 'Issue version set to: '.$version);
            return redirect()->back();
        }
        abort(403);
    }

}
