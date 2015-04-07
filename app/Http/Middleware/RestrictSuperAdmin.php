<?php namespace App\Http\Middleware;

use Closure;

class RestrictSuperAdmin {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$rank = \Auth::user()->rank;

		if($rank != 1) {
			abort(403);
		}

		return $next($request);
	}

}
