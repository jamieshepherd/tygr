<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;
use App\Project;
use Input;

class ClientController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clients = Client::all();

		return view('clients.index')->with('clients', $clients);
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
	 * @return Response
	 */
	public function store()
	{
		$client = new Client();
		$client->name	= Input::get('name');
		$client->stub	= Input::get('stub');
		$client->type	= Input::get('type');
		$result = $client->save();
		if($result) {
			\Session::flash('message', $client->name.' was created successfully.');
			return redirect('/clients/show/'.$client->stub);
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
		$client = Client::where('stub', '=', $stub)->firstOrFail();

		return view('clients.show')->with('client', $client);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client = Client::where('id', '=', $id)->firstOrFail();

		return view('clients.edit')->with('client', $client);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$client = Client::where('id', '=', $id)->firstOrFail();
		$client->name	= Input::get('name');
		$client->stub	= Input::get('stub');
		$client->type	= Input::get('type');
		$result = $client->save();
		if($result) {
			\Session::flash('message', $client->name.' was updated successfully.');
			return redirect('/clients/show/'.$client->stub);
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
		$client = Client::where('id', '=', $id)->firstOrFail();

		return view ('clients.delete')->with('client', $client);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Client::destroy($id);

		\Session::flash('message', 'This client was removed successfully.');
		return redirect('/clients');
	}

}
