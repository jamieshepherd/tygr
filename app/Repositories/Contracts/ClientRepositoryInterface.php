<?php namespace App\Repositories\Contracts;

use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;

interface ClientRepositoryInterface {

    /*
     * Retrieve all clients
     */
    public function getAll();

    /*
     * Find a specific client
     */
    public function find($id);

    /*
     * Create a new client
     */
    public function create(CreateClientRequest $request);

    /*
     * Update a client
     */
    public function update($id, UpdateClientRequest $request);

}

