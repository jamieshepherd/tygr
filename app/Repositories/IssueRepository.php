<?php namespace App\Repositories;

use App\Repositories\Contracts\IssueRepositoryInterface;

use Auth;
use Hash;
use App\Issue;
use App\IssueHistory;
use App\Group;
use App\Http\Requests\CreateIssueRequest;
use App\Http\Requests\UpdateIssueRequest;

use App\Commands\AddAttachmentCommand;
use App\Commands\DestroyAttachmentCommand;

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
        return Issue::find($id);
    }

    /*
     * Create a new issue
     *
     * @param  object  $project
     * @param  CreateUserRequest $request
     */
    public function create($project, CreateIssueRequest $request)
    {
        $issue = new Issue();
        $issue->hidden 	    = $request->has('hidden');
        $issue->author_id   = Auth::user()->id;
        $issue->project_id  = $project->id;
        $issue->summary     = $request->summary;
        $issue->priority    = 'Medium';
        $issue->version		= $project->current_version;
        $issue->reference   = $request->reference;
        $issue->description = $request->description;



        if($request->assigned == '1') {
            $groupid = Group::where('name', '=', 'Client')->first()->id;
            $issue->status         = 'Awaiting Client';
            $issue->assigned_to_id = $groupid;
        } else {
            $groupid = Group::where('name', '=', 'Sponge UK')->first()->id;
            $issue->status      = 'New';
            $issue->assigned_to_id = $groupid;
        }
        $result = $issue->save();

        if($request->file('attachment')) {
            $attachment = $request->file('attachment');
            $file = array(
                "filename"  => $attachment->getClientOriginalName(),
                "extension" => $attachment->getClientOriginalExtension(),
                "filetype"  => $attachment->getMimeType()
            );
            $attachment->move("uploads/tmp", $file['filename']);
            $this->dispatch(new AddAttachmentCommand($file, $issue->id, Auth::user()->id));
        }

        if($result) {
            $update             = new IssueHistory();
            $update->hidden     = false;
            $update->project_id = $issue->project->id;
            $update->issue_id   = $issue->id;
            $update->author_id  = $issue->author->id;
            $update->type       = 'status';
            $update->status     = 'created';
            $update->comment    = 'Issue was created';
            $update->save();
        }

        return $issue->id;
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