<?php namespace App\Repositories\Contracts;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

interface UserRepositoryInterface {

    /*
     * Retrieve all users
     */
    public function getAll();

    /*
     * Find a specific user
     */
    public function find($id);

    /*
     * Create a new user
     */
    public function create(CreateUserRequest $request);

    /*
     * Update a user
     */
    public function update($id, UpdateUserRequest $request);

}

