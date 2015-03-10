<?php namespace App\Repositories\Contracts;

use App\Http\Requests\CreateIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Http\Requests\UpdateIssueHistoryRequest;

interface IssueRepositoryInterface {

    /*
     * Retrieve all issues
     */
    public function getAll($project, $filter);

    /*
     * Find a specific issue
     */
    public function find($id);

    /*
     * Create a new issue
     */
    public function create($project, CreateIssueRequest $request);

    /*
     * Update an issue
     */
    public function update($id, UpdateIssueRequest $request);

    public function updateIssueHistory($id, UpdateIssueHistoryRequest $request);

    /*
     * Claim an issue
     */
    public function claim($idlist);

    public function resolve($id);

    public function close($idlist);

    public function reopen($id);

    public function assign($idlist, $group);

    public function changeVersion($idlist, $group);

    public function delete($idlist);
}

