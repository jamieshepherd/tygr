<?php namespace App\Http\Middleware;

use Closure;
use App\Project as Project;
class RestrictClient {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$client = \Auth::user()->client_id;
		$stub = $request->segment(2);
		$project = Project::where('stub', '=', $stub)->firstOrFail();

		if($client != 1 && $project->client_id != $client) {
			return response('Unauthorized.', 401);
		}

		return $next($request);
	}

}
