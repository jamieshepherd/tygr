<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\User;
use App\Group;
use App\Client;
use Illuminate\Support\Facades\Hash;

use App\Events\UserWasCreated;
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

		if($user->client_id == 1) {
			$user->attachToGroup('Sponge UK', $user->id);
        } else {
            $user->attachToGroup('Client', $user->id);
        }

		if(Input::has('spongeuk_project_management'))
			$user->attachToGroup('Sponge UK (Project Management)', $user->id);

		if(Input::has('spongeuk_development'))
			$user->attachToGroup('Sponge UK (Development)', $user->id);

		if(Input::has('spongeuk_visual_design'))
			$user->attachToGroup('Sponge UK (Visual Design)', $user->id);

		if(Input::has('spongeuk_instructional_design'))
			$user->attachToGroup('Sponge UK (Instructional Design)', $user->id);

        if(Input::has('spongeuk_launch_and_learn'))
            $user->attachToGroup('Sponge UK (Launch & Learn)', $user->id);

        if(Input::has('spongeuk_marketing'))
            $user->attachToGroup('Sponge UK (Marketing)', $user->id);

        if(Input::has('spongeuk_human_resources'))
            $user->attachToGroup('Sponge UK (Human Resources)', $user->id);

        if(Input::has('spongeuk_accounting'))
            $user->attachToGroup('Sponge UK (Accounting)', $user->id);

        if(Input::has('spongeuk_administration'))
            $user->attachToGroup('Sponge UK (Administration)', $user->id);

		if($result) {
			event(new UserWasCreated($user->id, $request->password));
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
		$user->client_id = Input::get('client_id');
		$user->rank      = $request->rank;
		$password        = $request->password;

		if(!empty($password)) {
			$user->password = Hash::make($password);
		}

		$result = $user->save();


		if(Input::has('spongeuk_project_management')) {
			if(!$user->belongsToGroup('Sponge UK (Project Management)')) {
				$user->attachToGroup('Sponge UK (Project Management)',$user->id);
            }
		} else {
			$user->detachFromGroup('Sponge UK (Project Management)',$user->id);
		}

		if(Input::has('spongeuk_development')) {
			if(!$user->belongsToGroup('Sponge UK (Development)')) {
 				$user->attachToGroup('Sponge UK (Development)',$user->id);
            }
		} else {
			$user->detachFromGroup('Sponge UK (Development)',$user->id);
		}

		if(Input::has('spongeuk_visual_design')) {
			if(!$user->belongsToGroup('Sponge UK (Visual Design)')) {
				$user->attachToGroup('Sponge UK (Visual Design)',$user->id);
            }
		} else {
			$user->detachFromGroup('Sponge UK (Visual Design)',$user->id);
		}

		if(Input::has('spongeuk_instructional_design')) {
			if(!$user->belongsToGroup('Sponge UK (Instructional Design)')) {
				$user->attachToGroup('Sponge UK (Instructional Design)',$user->id);
            }
		} else {
			$user->detachFromGroup('Sponge UK (Instructional Design)',$user->id);
		}

        if(Input::has('spongeuk_launch_and_learn')) {
            if(!$user->belongsToGroup('Sponge UK (Launch & Learn)')) {
                $user->attachToGroup('Sponge UK (Launch & Learn)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Launch & Learn)',$user->id);
        }

        if(Input::has('spongeuk_marketing')) {
            if(!$user->belongsToGroup('Sponge UK (Marketing)')) {
                $user->attachToGroup('Sponge UK (Marketing)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Marketing)',$user->id);
        }

        if(Input::has('spongeuk_human_resources')) {
            if(!$user->belongsToGroup('Sponge UK (Human Resources)')) {
                $user->attachToGroup('Sponge UK (Human Resources)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Human Resources)',$user->id);
        }

        if(Input::has('spongeuk_accounting')) {
            if(!$user->belongsToGroup('Sponge UK (Accounting)')) {
                $user->attachToGroup('Sponge UK (Accounting)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Accounting)',$user->id);
        }

        if(Input::has('spongeuk_administration')) {
            if(!$user->belongsToGroup('Sponge UK (Administration)')) {
                $user->attachToGroup('Sponge UK (Administration)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Administration)',$user->id);
        }

		if($result) {
			\Session::flash('message', $user->name.' was updated successfully.');
			return redirect('/users');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$user = User::where('id', '=', $id)->first();
		if(!$user) abort(404);

		if(isset($_GET['confirm']) && $_GET['confirm'] == true) {
			User::destroy($id);

			\Session::flash('message', 'This user was removed successfully.');
			return redirect('/users');
		}

		return view ('users.delete')->with('user', $user);
	}

}
