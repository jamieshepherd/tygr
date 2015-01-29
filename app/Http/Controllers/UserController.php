<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Input;
use Mail;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();

		return view('users.index')->with('users', $users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User();
		$user->name      = Input::get('name');
		$user->email     = Input::get('email');
		$user->client_id = Input::get('client');
		$user->rank      = Input::get('rank');
		$user->password  = Input::get('password');
		$result = $user->save();

		if($result) {
			Mail::send('emails.welcome', array('name' => Input::get('name'), 'email' => Input::get('email'), 'password' => Input::get('password')), function($message) {
				$message->to(Input::get('email'), Input::get('name'))->subject('Welcome!');
			});
			\Session::flash('message', $user->name.' was created successfully.');
			return redirect('/users');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);

		return view('users.show')->with('user', $user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);

		return view('users.edit')->with('user', $user);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
		$user->name      = Input::get('name');
		$user->email     = Input::get('email');
		$user->client_id = Input::get('client');
		$user->rank      = Input::get('rank');
		$password        = Input::get('password');

		if(!empty($password)) {
			$user->password = Hash::make($password);
		}

		$result = $user->save();

		if($result) {
			\Session::flash('message', $user->name.' was updated successfully.');
			return redirect('/users');
		}
	}

	/**
	 * Show confirmation for deletion of a resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$user = User::where('id', '=', $id)->firstOrFail();

		return view ('users.delete')->with('user', $user);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);

		\Session::flash('message', 'This user was removed successfully.');
		return redirect('/users');
	}

}
