<?php namespace App\Repositories;

use App\Repositories\Contracts\IssueRepositoryInterface;

use Hash;
use App\Issue;
use App\Http\Requests\CreateIssueRequest;
use App\Http\Requests\UpdateIssueRequest;

class IssueRepository implements IssueRepositoryInterface {

    /*
     * Retrieve all issues
     *
     * @return  Client
     */
    public function getAll()
    {
        //
    }

    /*
     * Find a specific issue
     *
     * @param  int  $id
     *
     * @return  Client
     */
    public function find($id)
    {
        //
    }

    /*
     * Create a new issue
     *
     * @param  CreateUserRequest $request
     */
    public function create(CreateIssueRequest $request)
    {
        //
    }

    /*
     * Update an issue
     *
     * @param  int  $id
     * @param  UpdateUserRequest  $request
     */
    public function update($id, UpdateIssueRequest $request) {
        //
    }

    /*
     * Delete an issue
     */
    public function delete($id) {
        //
    }

}