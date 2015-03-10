<?php namespace App\Repositories;

use App\Repositories\Contracts\ClientRepositoryInterface;

use Hash;
use App\Client;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;

class ClientRepository implements ClientRepositoryInterface {

    /*
     * Retrieve all clients
     *
     * @return  Client
     */
    public function getAll()
    {
        return Client::all();
    }

    /*
     * Find a specific client
     *
     * @param  int  $id
     *
     * @return  Client
     */
    public function find($id)
    {
        return Client::find($id);
    }

    /*
     * Find a client by its stub
     *
     * @param  string  $stub
     */
    public function findByStub($stub)
    {
        return Client::where('stub', '=', $stub)->first();
    }

    /*
     * Create a new client
     *
     * @param  CreateUserRequest $request
     */
    public function create(CreateClientRequest $request)
    {
        $client = new Client();
        $client->name	= $request->name;
        $client->stub	= $request->stub;
        $client->type	= $request->type;
        return $client->save();
    }

    /*
     * Update a client
     *
     * @param  int  $id
     * @param  UpdateUserRequest  $request
     */
    public function update($id, UpdateClientRequest $request) {
        $client = $this->find($id);
        if(!$client) abort(404);

        $client->name	= $request->name;
        $client->stub	= $request->stub;
        $client->type	= $request->type;

        return $client->save();
    }

    /*
     * Delete a client
     */
    public function delete($id) {
        return Client::destroy($id);
    }

}