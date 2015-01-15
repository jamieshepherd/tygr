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
		$client = \Auth::user()->client;
		$stub = $request->segment(2);
		$project = Project::where('stub', '=', $stub)->firstOrFail();

		if($client != null && $project->client != $client) {
			return response('Unauthorized.', 401);
		}

		return $next($request);
	}

}
