<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAccountRequest;
use Input;
use Hash;

class AccountController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('account.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @return Response
	 */
	public function edit()
	{
		return view('account.edit');
	}

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAccountRequest $request
     * @return Response
     */
	public function update(UpdateAccountRequest $request)
	{
		$user = \Auth::user();
		$user->name  = $request->name;
        $user->email = $request->email;
		$oldpass     = Input::get('oldpass');
		$newpass     = Input::get('newpass');
		$confirmpass = Input::get('confirmpass');
		if(!empty($oldpass) || !empty($newpass) || $confirmpass) {
			// Check oldpass is true
			if(Hash::check($oldpass,$user->password)) {
				// Check newpass and confirmpass are the same
				if($newpass == $confirmpass) {
					$user->password = Hash::make($newpass);
				} else {
					\Session::flash('notify-type', 'error');
					\Session::flash('message', 'Passwords provided were not the same.');
					return redirect('/account');
				}
			} else {
				\Session::flash('notify-type', 'error');
				\Session::flash('message', 'The old password provided was incorrect.');
				return redirect('/account');
			}
		}
		$result = $user->save();
		if($result) {
			\Session::flash('message', $user->name.' was updated successfully.');
			return redirect('/account');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
