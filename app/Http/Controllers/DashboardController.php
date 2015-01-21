<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {

	/**
	 * Display the admin dashboard.
	 *
	 * @return Response
	 */
	public function show()
	{
		return view('dashboard.show');
	}

}
