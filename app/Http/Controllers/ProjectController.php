<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Project;
use App\User;
use Input;

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
	 * @param  string  $stub
	 * @return Response
	 */
	public function create($stub)
	{
		$client = Client::where('stub', '=', $stub)->firstOrFail();
		return view('projects.create')->with('client', $client);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($stub)
	{
		$client = Client::where('stub', '=', $stub)->firstOrFail();

		$project = new Project();
		$project->client_id					 = $client->id;
		$project->name				         = Input::get('name');
		$project->stub				         = Input::get('stub');
		$project->current_version	         = Input::get('current_version');
		$project->status			         = Input::get('status');
		$project->authoring_tool             = Input::get('authoring_tool');
		$project->lms_location               = Input::get('lms_location');
		$project->lms_specification          = Input::get('lms_specification');
		$project->project_manager_id   		 = Input::get('project_manager');
		$project->lead_developer_id    		 = Input::get('lead_developer');
		$project->lead_designer_id     		 = Input::get('lead_designer');
		$project->instructional_designer_id  = Input::get('instructional_designer');
		$project->authoring_tool             = Input::get('authoring_tool');
		$project->lms_location               = Input::get('lms_location');
		$project->lms_specification          = Input::get('lms_specification');

		$result = $project->save();
		if($result) {
			\Session::flash('message', $project->name.' was created successfully.');
			return redirect('/projects/'.$project->stub);
		}
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
	 * @param  string  $stub
	 * @return Response
	 */
	public function update($stub)
	{
		$project = Project::where('stub', '=', $stub)->firstOrFail();
		$project->name				         = Input::get('name');
		$project->stub				         = Input::get('stub');
		$project->current_version	         = Input::get('current_version');
		$project->status			         = Input::get('status');
		$project->authoring_tool             = Input::get('authoring_tool');
		$project->lms_deployment             = Input::get('lms_deployment');
		$project->lms_specification          = Input::get('lms_specification');
		$project->project_manager_id   		 = Input::get('project_manager');
		$project->lead_developer_id    		 = Input::get('lead_developer');
		$project->lead_designer_id     		 = Input::get('lead_designer');
		$project->instructional_designer_id  = Input::get('instructional_designer');
		$project->authoring_tool             = Input::get('authoring_tool');
		$project->lms_deployment             = Input::get('lms_deployment');
		$project->lms_specification          = Input::get('lms_specification');
		$result = $project->save();
		if($result) {
			\Session::flash('message', 'Project details updated successfully.');
			return redirect('/projects/'.$project->stub);
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

}
