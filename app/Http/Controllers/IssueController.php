<?php namespace App\Http\Controllers;

use App\Commands\AddAttachmentCommand;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Project;
use App\Issue;
use App\IssueHistory;
use Input;

class IssueController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $client;
	 * @param  string  $stub;
	 * @return Response
	 */
	public function index($client, $stub)
	{
		$client = Client::where('stub', '=', $client)->first();
		if(!$client) abort(404);

		$project = Project::where('client_id', '=', $client->id)->where('stub', '=', $stub)->first();
		if(!$project) abort(404);

		$issues = Issue::where('project_id','=',$project->id)
			->where('version', '=', $project->current_version)
			->orderBy('status_id')
			->get();

		$versions = Issue::where('project_id', '=', $project->id)->distinct()->select('version')->get();

		return view('issues.index')->with('project', $project)->with('issues', $issues)->with('versions', $versions);
	}

	/**
	 * Display a listing of the resource, filtered.
	 *
	 * @param  string  $client;
	 * @param  string  $stub;
	 * @param  string  $filter;
	 * @return Response
	 */
	public function filter($client, $stub, $filter)
	{
		$userGroups = \Auth::User()->groups->lists('id');

		$client = Client::where('stub', '=', $client)->first();
		if(!$client) abort(404);

		$project = Project::where('client_id', '=', $client->id)->where('stub', '=', $stub)->first();
		if(!$project) abort(404);

		if($filter == 'me') {
			$issues = Issue::whereIn('assigned_to_id', $userGroups)
				->where('project_id','=',$project->id)
				->orderBy('status_id')
				->get();
			$filter = 'Assigned to me';
		} elseif($filter == 'all') {
			$issues = $project->issues;
			$filter = 'All issues';
		}
		else {
			$issues = Issue::where('project_id','=',$project->id)
				->where('version', '=', $filter)
				->orderBy('status_id')
				->get();
		}

		$versions = Issue::where('project_id', '=', $project->id)->distinct()->select('version')->get();

		return view('issues.index')
			->with('project', $project)
			->with('issues', $issues)
			->with('filter', $filter)
			->with('versions', $versions);
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
		$project = Project::where('stub', '=', $stub)->firstOrFail();

		return view("issues.create")->with('project', $project);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  string  $client;
	 * @param  string  $stub;
	 * @return Response
	 */
	public function store($client, $stub)
	{
		$issue = new Issue();
		$project = Project::where('stub', '=', $stub)->firstOrFail();
		$issue->hidden 	    = Input::has('hidden');
		$issue->author_id   = \Auth::user()->id;
		$issue->project_id  = $project->id;
		$issue->type        = Input::get('type');
		$issue->status_id      = 1;
		$issue->priority    = 'Medium';
		$issue->assigned_to_id = 2;
		$issue->version		   = $project->current_version;
		$issue->reference   = Input::get('reference');
		$issue->description = Input::get('description');

		$result = $issue->save();
		if(Input::file('attachment')) {
			$file = Input::file('attachment');
			$this->dispatch(new AddAttachmentCommand($file, $issue->id));
		}

		if($result) {
			$update = new IssueHistory();
			$update->issue_id   = $issue->id;
			$update->author_id  = $issue->author->id;
			$update->type		= 'status';
			$update->status     = 'created';
			$update->comment    = 'Issue was created';
			$update->save();

			\Session::flash('message', 'Your issue was created successfully');
			return redirect('projects/'.$client.'/'.$stub.'/issues/show/'.$issue->id);
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
		$project = Project::where('stub', '=', $stub)->firstOrFail();
		$issue = Issue::where('project_id', '=', $project->id)->where('id', '=', $id)->firstOrFail();
		return view('issues.show')->with('project', $project)->with('issue', $issue);
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
		$issue = Issue::find($id);
		return view('issues.edit')->with('issue', $issue);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  string  $client
	 * @param  string  $stub
	 * @param  int  $id
	 * @return Response
	 */
	public function update($client, $stub, $id)
	{
		$issue = Issue::find($id);
		$issue->hidden 	= Input::has('public');
		$issue->type        = Input::get('type');
		$issue->priority    = 'Medium';
		$issue->reference   = Input::get('reference');
		$issue->description = Input::get('description');
		$result = $issue->save();

		if($result) {
			$update = new IssueHistory();
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
		$issue = Issue::find($id);

		if(Input::file('attachment')) {
			$file = Input::file('attachment');
			$this->dispatch(new AddAttachmentCommand($file, $id));
		}
		if(Input::get('priority')) {
			$issue->priority = Input::get('priority');
			$issue->save();
		}

		if(Input::get('comment')) {
			$update = new IssueHistory();
			$update->issue_id   = $issue->id;
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
			$update->issue_id   = $issue->id;
			$update->author_id  = \Auth::user()->id;
			$update->type		= 'status';
			$update->status     = 'assigned';
			if($issue->assigned_to->name == 'Client') {
				$issue->status_id  = 3;
				$issue->save();
				$update->comment    = 'Issue was assigned to '.$issue->project->client->name;
			} else {
				$issue->status_id  = 2;
				$issue->save();
				$update->comment    = 'Issue was assigned to '.$issue->assigned_to->name;
			}
			$update->save();
		}

		if(Input::get('resolved')) {
			$issue->status_id	= 4;
			$result = $issue->save();

			if($result) {
				$update = new IssueHistory();
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
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($client, $stub, $id)
	{
		Issue::destroy($id);

		\Session::flash('message', 'The issue was removed successfully.');
		return redirect('projects/');
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
		$issue = Issue::where('id', '=', $id)->firstOrFail();
		$issue->status_id = 4;
		$issue->assigned_to_id = 1;
		$result = $issue->save();

		if($result) {
			$update = new IssueHistory();
			$update->issue_id = $issue->id;
			$update->author_id = \Auth::user()->id;
			$update->type = 'status';
			$update->status = 'resolved';
			$update->comment = 'Issue was changed to resolved';
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
		$issue = Issue::where('id', '=', $id)->firstOrFail();
		$issue->status_id = 5;
		$result = $issue->save();

		if($result) {
			$update = new IssueHistory();
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
		$issue = Issue::where('id', '=', $id)->firstOrFail();
		$issue->status_id = 2;
		$result = $issue->save();

		if($result) {
			$update = new IssueHistory();
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

}
