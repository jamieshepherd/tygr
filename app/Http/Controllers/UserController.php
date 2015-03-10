<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\ClientRepositoryInterface;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller {

    protected $users;
    protected $clients;

    /**
     * Construct the controller with users repository
     *
     * @param UserRepositoryInterface $users
     * @param ClientRepositoryInterface $clients
     */
    public function __construct(UserRepositoryInterface $users, ClientRepositoryInterface $clients) {
        $this->users   = $users;
        $this->clients = $clients;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->users->getAll();

		return view('users.index')->with(compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$clients = $this->clients->getAll();
		return view('users.create')->with(compact('clients'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateUserRequest $request
	 * @return Response
	 */
	public function store(CreateUserRequest $request)
	{
        $result = $this->users->create($request);

		if($result) {
			session()->flash('message', $request->name.' was created successfully.');
			return redirect()->back();
		} else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
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
		$user = $this->users->find($id);

		return view('users.show')->with(compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = $this->users->find($id);
		$clients = $this->clients->getAll();

		return view('users.edit')->with(compact('user', 'clients'));
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
		$result = $this->users->update($id, $request);

        if($result) {
            session()->flash('message', $request->name.' was updated successfully.');
            return redirect('/users');
        } else {
            session()->flash('notify-type', 'error');
            session()->flash('message', 'This was unsuccessful, please try again.');
            return redirect()->back();
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
        if(isset($_GET['confirm']) && $_GET['confirm'] == true) {
            $result = $this->users->delete($id);
            if($result) {
                session()->flash('message', 'This user was removed successfully.');
                return redirect('/users');
            } else {
                session()->flash('notify-type', 'error');
                session()->flash('message', 'This was unsuccessful, please try again.');
                return redirect()->back();
            }
        }

        $user = $this->users->find($id);
        return view ('users.delete')->with(compact('user'));
	}

}
