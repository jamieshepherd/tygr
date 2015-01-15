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
	 * @param  string  $cstub;
	 * @param  string  $pstub;
	 * @return Response
	 */
	public function index($cstub, $pstub)
	{
		$client = Client::where('stub', '=', $cstub)->firstOrFail();
		$project = Project::where('stub', '=', $pstub)->firstOrFail();
		$issues = Issue::all();
		return view('issues')->with('client', $client)->with('project', $project)->with('issues', $issues);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param  string  $cstub;
	 * @param  string  $pstub;
	 * @return Response
	 */
	public function create($cstub, $pstub)
	{
		$client = Client::where('stub', '=', $cstub)->firstOrFail();
		$project = Project::where('stub', '=', $pstub)->firstOrFail();
		return view("issues.create")->with('client', $client)->with('project', $project);
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
	 * @param  string  $cstub
	 * @param  string  $pstub
	 * @param  int  $id
	 * @return Response
	 */
	public function show($cstub, $pstub, $id)
	{
		$client = Client::where('stub', '=', $cstub)->firstOrFail();
		$project = Project::where('stub', '=', $pstub)->firstOrFail();
		$issue = Issue::where('id', '=', $id)->firstOrFail();
		return view('issue')->with('client', $client)->with('project', $project)->with('issue', $issue);
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
