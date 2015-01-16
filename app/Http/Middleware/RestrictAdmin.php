<?php namespace App\Http\Middleware;

use Closure;

class RestrictAdmin {

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

		if($client != 1) {
			return response('Unauthorized.', 401);
		}

		return $next($request);
	}

}
