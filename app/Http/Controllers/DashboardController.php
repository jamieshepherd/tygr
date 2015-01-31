<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Project;
use App\Issue;
use App\Client;
use App\IssueHistory;
use DB;

class DashboardController extends Controller {

	/**
	 * Display the admin dashboard.
	 *
	 * @return Response
	 */
	public function show()
	{
		$previous_week = strtotime("-1 week +1 day");
		$start_week = strtotime("last sunday midnight",$previous_week);
		$end_week = strtotime("next saturday",$start_week);
		$start_week = date("Y-m-d",$start_week);
		$end_week = date("Y-m-d",$end_week);

		$projects = Project::selectRaw('*')
			->selectRaw('(SELECT COUNT(*) FROM issues i WHERE i.project_id = projects.id AND i.created_at >= '.$end_week.') AS issueCount')
			->orderBy('issueCount', 'DESC')
			->take(5)
			->get();

		// Give each alternating project a different colour
		$i = 1;
		foreach($projects as $project) {
			if($i % 2 == 1) { $project->color = '#8BCEDC'; }
			else { $project->color = '#f24a33';	}
			$i++;
		}

		$data = array(
			'project_count'        => count(Project::all()),
			'client_count'         => count(Client::all()),
			'issue_count'          => count(Issue::where('status_id', '!=', 5)->get()),
			'issues_created'       => $projects,
			'issues_resolved'      => count(IssueHistory::where('status', '=', 'resolved')
				->where('created_at', '>=', $end_week)->get())
		);
		return view('dashboard.show')->with('data',$data)->with('start_week',$start_week);
	}

}
