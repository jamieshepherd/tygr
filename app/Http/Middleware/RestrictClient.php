<?php namespace App\Http\Middleware;

use Closure;
use Auth;
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
		$client = $request->segment(2);

		if(Auth::user()->client_id != 1 && $client != Auth::user()->client->stub) {
			abort(401);
		}

		return $next($request);
	}

}
