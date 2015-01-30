<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Issue;
use App\Client;

class DashboardController extends Controller {

	/**
	 * Display the admin dashboard.
	 *
	 * @return Response
	 */
	public function show()
	{
		$data = array(
			'project_count'    => count(Project::all()),
			'client_count'     => count(Client::all()),
			'issue_count'      => count(Issue::where('status_id', '!=', 5)->get())
		);
		return view('dashboard.show')->with('data',$data);
	}

}
