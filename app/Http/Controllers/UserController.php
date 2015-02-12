<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use Illuminate\Support\Facades\Hash;
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
		$clients = Client::all();
		return view('users.create')->with('clients',$clients);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateUserRequest $request
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{

		$user = new User();
		$user->name      = $request->name;
		$user->email     = $request->email;
		$user->client_id = Input::get('client_id');
		$user->rank      = $request->rank;
		$user->password  = Hash::make($request->password);
		$result = $user->save();

		if($user->client_id != 1)
			$user->attachToGroup(1,$user->id);

		if(Input::has('spongeuk_project_management'))
			$user->attachToGroup(3,$user->id);

		if(Input::has('spongeuk_development'))
			$user->attachToGroup(4,$user->id);

		if(Input::has('spongeuk_visual_design'))
			$user->attachToGroup(5,$user->id);

		if(Input::has('spongeuk_instructional_design'))
			$user->attachToGroup(6,$user->id);

		if($result) {
			/* handle this with an event
			Mail::send('emails.welcome', array(
				'name' => $user->name,
				'email' => $user->email,
				'password' => $user->password), function($message) use($user) {
					$message->to($user->email, $user->name)->subject('Welcome!');
				}
			); */
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
		$clients = Client::all();

		return view('users.edit')->with('user', $user)->with('clients', $clients);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param UpdateUserRequest $request
	 * @return Response
	 */
	public function update($id, UpdateUserRequest $request)
	{
		$user = User::find($id);

		$user->name      = $request->name;
		$user->email     = $request->email;
		$user->client_id = $request->client;
		$user->rank      = $request->rank;
		$password        = $request->password;

		if(!empty($password)) {
			$user->password = Hash::make($password);
		}

		$result = $user->save();

		if(Input::has('spongeuk_project_management')) {
			if(!$user->belongsToGroup(3))
				$user->attachToGroup(3,$user->id);
		} else {
			$user->detachFromGroup(3,$user->id);
		}

		if(Input::has('spongeuk_development')) {
			if(!$user->belongsToGroup(4))
				$user->attachToGroup(4,$user->id);
		} else {
			$user->detachFromGroup(4,$user->id);
		}

		if(Input::has('spongeuk_visual_design')) {
			if(!$user->belongsToGroup(5))
				$user->attachToGroup(5,$user->id);
		} else {
			$user->detachFromGroup(5,$user->id);
		}

		if(Input::has('spongeuk_instructional_design')) {
			if(!$user->belongsToGroup(6))
				$user->attachToGroup(6,$user->id);
		} else {
			$user->detachFromGroup(6,$user->id);
		}

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
