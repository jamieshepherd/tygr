<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Project;
use App\Issue;

class IssueController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @param  string  $stub;
	 * @return Response
	 */
	public function index($stub)
	{
		$project = Project::where('stub', '=', $stub)->firstOrFail();
		$issues = $project->issues;
		return view('issues.index')->with('project', $project)->with('issues', $issues);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  string  $stub;
	 * @return Response
	 */
	public function create($stub)
	{
		$project = Project::where('stub', '=', $stub)->firstOrFail();
		return view("issues.create")->with('project', $project);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $stub
	 * @param  int  $id
	 * @return Response
	 */
	public function show($stub, $id)
	{
		$project = Project::where('stub', '=', $stub)->firstOrFail();
		$issue = Issue::where('project', '=', $project->id)->where('id', '=', $id)->firstOrFail();
		return view('issues.show')->with('project', $project)->with('issue', $issue);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

}
