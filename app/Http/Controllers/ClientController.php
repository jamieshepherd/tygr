<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Repositories\Contracts\ClientRepositoryInterface;

use App\Http\Requests;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientController extends Controller {

    protected $clients;

    /**
     * Construct the controller with users repository
     *
     * @param ClientRepositoryInterface $clients
     */
    public function __construct(ClientRepositoryInterface $clients) {
        $this->clients = $clients;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clients = $this->clients->getAll();

		return view('clients.index')->with(compact('clients'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('clients.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CreateClientRequest $request
	 * @return Response
	 */
	public function store(CreateClientRequest $request)
	{
		$result = $this->clients->create($request);

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
	 * @param  string  $stub
	 * @return Response
	 */
	public function show($stub)
	{
		$client = $this->clients->findByStub($stub);

		if(!$client) abort(404);

		return view('clients.show')->with(compact('client'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client = $this->clients->find($id);

		return view('clients.edit')->with(compact('client'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int $id
	 * @param UpdateClientRequest $request
	 * @return Response
	 */
	public function update($id, UpdateClientRequest $request)
	{
		$result = $this->clients->update($id, $request);

        if($result) {
            session()->flash('message', $request->name.' was updated successfully.');
            return redirect('/clients/show/'.$request->stub);
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
            $result = $this->clients->delete($id);
            if($result) {
                session()->flash('message', 'This client was removed successfully.');
                return redirect('/clients');
            } else {
                session()->flash('notify-type', 'error');
                session()->flash('message', 'This was unsuccessful, please try again.');
                return redirect()->back();
            }
        }

        $client = $this->clients->find($id);
        return view ('clients.delete')->with(compact('client'));
	}

}
