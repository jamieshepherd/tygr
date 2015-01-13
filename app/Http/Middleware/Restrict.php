<?php namespace App\Http\Middleware;

use Closure;
use App\Client;
use App\User;

class Restrict {

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

		if($client != null && $request->segment(2) != $client->stub) {
			return response('Unauthorized.', 401);
		}

		return $next($request);
	}

}
