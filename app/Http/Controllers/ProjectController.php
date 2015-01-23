<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Project;
use App\User;

class ProjectController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $client_id = \Auth::user()->client_id;
		$client = Client::where('id', '=', $client_id)->firstOrFail();
        return view('projects.index')->with('client', $client);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
	 * @return Response
	 */
	public function show($stub)
	{
        $client = \Auth::user()->client_id;

		if($client == 1) {
			$project = Project::where('stub', '=', $stub)
				->firstOrFail();
		} else {
			$project = Project::where('client_id', '=', $client)
				->where('stub', '=', $stub)
				->firstOrFail();
		}

		return view('projects.show')->with('project', $project);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $stub
	 * @return Response
	 */
	public function edit($stub)
	{
		$client = \Auth::user()->client_id;

		if($client == 1) {
			$project = Project::where('stub', '=', $stub)
				->firstOrFail();
		} else {
			$project = Project::where('client_id', '=', $client)
				->where('stub', '=', $stub)
				->firstOrFail();
		}

		return view('projects.edit')->with('project', $project);
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
