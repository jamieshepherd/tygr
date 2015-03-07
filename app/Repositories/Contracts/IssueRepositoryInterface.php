<?php namespace App\Repositories\Contracts;

use App\Http\Requests\CreateIssueRequest;
use App\Http\Requests\UpdateIssueRequest;

interface IssueRepositoryInterface {

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
    public function create(CreateIssueRequest $request);

    /*
     * Update a client
     */
    public function update($id, UpdateIssueRequest $request);

}

