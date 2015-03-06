<?php namespace App\Repositories\Contracts;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

interface ProjectRepositoryInterface {

    /*
     * Retrieve all projects
     */
    public function getAll();

    /*
     * Retrieve all projects for current user
     */
    public function getMyProjects();

    /*
     * Find a specific project
     */
    public function find($id);

    /*
     * Create a new project
     */
    public function create($client, CreateProjectRequest $request);

    /*
     * Update a project
     */
    public function update($id, UpdateProjectRequest $request);

}

