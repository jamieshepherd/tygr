<?php namespace App\Repositories\Contracts;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

interface ProjectRepositoryInterface {

    /*
     * Create a new project
     */
    public function create($client, CreateProjectRequest $request);

    /*
     * Update a project
     */
    public function update($id, UpdateProjectRequest $request);

    /*
     * Retrieve all projects
     */
    public function getAll();

    /*
     * Retrieve all projects for current user
     */
    public function getMyProjects();

    /*
     * Find a specific project by ID
     */
    public function find($id);

    /*
     * Find a specific project by stub
     *
     * @param  string  $stub
     */
    public function findByStub($stub);

    /*
     * Return the recent activity of a project
     *
     * @param  string  $stub
     */
    public function recentActivity($id);

    /*
     * Return the recent activity of a project
     *
     * @param  string  $stub
     */
    public function getStatistics($id);

    /*
     * Delete a project
     *
     * @param  int  $id
     */
    public function delete($id);

    /*
     * Change version
     *
     * @param  string  $stub
     * @param  float  $version
     */
    public function changeVersion($stub, $version);

}

