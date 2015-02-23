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

		$this->makeColourful($projects);

		$data = array(
			'project_count'        => count(Project::all()),
			'client_count'         => count(Client::all()),
			'issue_count'          => count(Issue::where('status', '!=', 'Closed')->get()),
			'issues_created'       => $projects,
			'issues_resolved'      => count(IssueHistory::where('status', '=', 'resolved')
				->where('created_at', '>=', $end_week)->get())
		);
		return view('dashboard.show')->with('data',$data)->with('start_week',$start_week);
	}

	public function makeColourful($projects)
	{
		// Give each alternating project a different colour
		$i = 0;
		foreach($projects as $project) {
			$i++;
			switch($i) {
				case 1:
					$project->color = '#8BCEDC';
					break;
				case 2:
					$project->color = '#f24a33';
					break;
				case 3:
					$project->color = '#be63c5';
					break;
				case 4:
					$project->color = '#accd4a';
					break;
				default:
					$project->color = '#ff6600';
			}
		}
	}

}
