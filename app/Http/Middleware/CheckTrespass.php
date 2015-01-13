<?php namespace App\Http\Middleware;

use Closure;

class CheckTrespass {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if($request) {
			echo \Auth::user()->client()->stub();
			echo $request->segment(2);
		} else {
			return response('Unauthorized.', 401);
		}
	}

}
