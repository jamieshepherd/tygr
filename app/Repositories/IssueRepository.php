<?php namespace App\Repositories;

use App\Repositories\Contracts\IssueRepositoryInterface;

use DB;
use Auth;
use Hash;
use Illuminate\Foundation\Bus\DispatchesCommands;
use App\Issue;
use App\IssueHistory;
use App\Group;
use App\Http\Requests\CreateIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Http\Requests\UpdateIssueHistoryRequest;

use App\Commands\AddAttachmentCommand;
use App\Commands\DestroyAttachmentCommand;

class IssueRepository implements IssueRepositoryInterface {

    use DispatchesCommands;

    /*
     * Retrieve all issues
     *
     * @return  Client
     */
    public function getAll($project, $filter)
    {
        // Check if the results should be filtered
        if(!$filter) {
            $issues = Issue::where('project_id','=',$project->id)
                ->where('status', '!=', 'Closed')
                ->where('version', '=', $project->current_version)
                ->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                            WHEN status = 'Assigned' THEN '2'
                                            WHEN status = 'Awaiting Client' THEN '3'
                                            WHEN status = 'Resolved' THEN '4'
                                            WHEN status = 'Closed' THEN '5'
                                        END"), 'ASC')
                ->get();
        } elseif($filter == 'me') {
                $userGroups = Auth::User()->groups->lists('id');
                $issues = Issue::whereIn('assigned_to_id', $userGroups)
                    ->where('status', '!=', 'Closed')
                    ->where('project_id','=',$project->id)
                    ->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                            WHEN status = 'Assigned' THEN '2'
                                            WHEN status = 'Awaiting Client' THEN '3'
                                            WHEN status = 'Resolved' THEN '4'
                                            WHEN status = 'Closed' THEN '5'
                                        END"), 'ASC')
                    ->get();
        } elseif($filter == 'closed') {
            $issues = Issue::where('project_id', '=', $project->id)
                ->where('status', '=', 'Closed')
                ->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                        WHEN status = 'Assigned' THEN '2'
                                        WHEN status = 'Awaiting Client' THEN '3'
                                        WHEN status = 'Resolved' THEN '4'
                                        WHEN status = 'Closed' THEN '5'
                                    END"), 'ASC')
                ->get();
        }  elseif($filter == 'all') {
            $issues = Issue::where('project_id', '=', $project->id)
                ->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                        WHEN status = 'Assigned' THEN '2'
                                        WHEN status = 'Awaiting Client' THEN '3'
                                        WHEN status = 'Resolved' THEN '4'
                                        WHEN status = 'Closed' THEN '5'
                                    END"), 'ASC')
                ->get();
        }
        else {
            $issues = Issue::where('project_id','=',$project->id)
                ->where('status', '!=', 'Closed')
                ->where('version', '=', $filter)
                ->orderBy(DB::raw("CASE WHEN status = 'New' THEN '1'
                                        WHEN status = 'Assigned' THEN '2'
                                        WHEN status = 'Awaiting Client' THEN '3'
                                        WHEN status = 'Resolved' THEN '4'
                                        WHEN status = 'Closed' THEN '5'
                                    END"), 'ASC')
                ->get();
        }

        return $issues;
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
            $issue->status         = 'New';
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
            $update->comment    = 'Amendment was created';
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
    public function update($id, UpdateIssueRequest $request)
    {
        $issue              = $this->find($id);
        $issue->hidden 	    = $request->has('hidden');
        $issue->summary     = $request->summary;
        $issue->priority    = 'Medium';
        $issue->reference   = $request->reference;
        $issue->description = $request->description;
        $result             = $issue->save();

        if($result) {
            $update             = new IssueHistory();
            $update->hidden     = false;
            $update->project_id = $issue->project->id;
            $update->issue_id   = $issue->id;
            $update->author_id  = $issue->author->id;
            $update->type       = 'status';
            $update->status     = 'updated';
            $update->comment    = 'Amendment was edited';
            $update->save();
        }

        return true;
    }

    public function updateIssueHistory($id, UpdateIssueHistoryRequest $request)
    {
        $issue = $this->find($id);

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

        if($request->priority) {
            $issue->priority = $request->priority;
            $issue->save();
        }

        if($request->comment) {
            $update = new IssueHistory();
            $update->project_id = $issue->project->id;
            $update->issue_id   = $issue->id;
            $update->hidden     = $request->has('hidden');
            $update->author_id  = Auth::user()->id;
            $update->type		= 'comment';
            $update->comment    = $request->comment;
            $update->save();
        }

        if($request->assigned_to != $issue->assigned_to->id) {

            $issue->assigned_to_id = $request->assigned_to;
            $issue->save();
            $issue = Issue::find($id);

            $update = new IssueHistory();
            $update->hidden     = false;
            $update->project_id = $issue->project->id;
            $update->issue_id   = $issue->id;
            $update->author_id  = Auth::user()->id;
            $update->type		= 'status';
            $update->status     = 'assigned';
            if($issue->assigned_to->name == 'Client') {
                $issue->status   = 'Awaiting Client';
                $issue->save();
                $update->comment = 'Amendment was assigned to '.$issue->project->client->name;
            } else {
                $issue->status   = 'Assigned';
                $issue->save();
                $update->comment = 'Amendment was assigned to '.$issue->assigned_to->name;
            }
            $update->save();
        }

        /*
        if($request->has('resolved')) {
            $assigned_to_id        = Group::where('name', '=', 'Client')->first()->id;
            $issue->status	       = 'Resolved';
            $issue->assigned_to_id = $assigned_to_id;
            $result                = $issue->save();

            if($result) {
                $update = new IssueHistory();
                $update->hidden     = false;
                $update->project_id = $issue->project->id;
                $update->issue_id   = $issue->id;
                $update->author_id  = Auth::user()->id;
                $update->type       = 'status';
                $update->status     = 'resolved';
                $update->comment    = 'Issue was changed to resolved';
                $update->save();

            }
        }
        */

        return true;
    }

    /*
     * Claim an issue
     */
    public function claim($idlist)
    {
        // Check if we have multiple IDs to claim
        $idArray = explode(',', $idlist);
        foreach($idArray as $id) {
            $issue 				  = Issue::find($id);
            $issue->claimed_by_id = Auth::user()->id;
            $issue->save();
        }

        return true;
    }

    public function resolve($id)
    {
        $issue                  = $this->find($id);
        $issue->status          = 'Resolved';
        $issue->assigned_to_id  = Group::where('name', '=', 'Client')->first()->id;;
        $result                 = $issue->save();

        if($result) {
            $update             = new IssueHistory();
            $update->hidden     = false;
            $update->project_id = $issue->project->id;
            $update->issue_id   = $issue->id;
            $update->author_id  = \Auth::user()->id;
            $update->type       = 'status';
            $update->status     = 'resolved';
            $update->comment    = 'Amendment was changed to resolved';
            $update->save();
        }

        return true;
    }

    public function close($id)
    {
        $issue         = $this->find($id);
        $issue->status = 'Closed';
        $result        = $issue->save();

        if($result) {
            $update             = new IssueHistory();
            $update->hidden     = false;
            $update->project_id = $issue->project->id;
            $update->issue_id   = $issue->id;
            $update->author_id  = Auth::user()->id;
            $update->type       = 'status';
            $update->status     = 'closed';
            $update->comment    = 'Amendment was closed';
            $update->save();
        }

        return true;
    }

    public function reopen($id)
    {
        $issue         = $this->find($id);
        $issue->status = 'Assigned';
        $result        = $issue->save();

        if($result) {
            $update             = new IssueHistory();
            $update->hidden     = false;
            $update->project_id = $issue->project->id;
            $update->issue_id   = $issue->id;
            $update->author_id  = \Auth::user()->id;
            $update->type       = 'status';
            $update->status     = 'reopened';
            $update->comment    = 'Amendment was reopened';
            $update->save();
        }

        return $result;
    }

    public function assign($idlist, $group)
    {
        if($group == 'sponge') {
            $groupid = Group::where('name', '=', 'Sponge UK')->first()->id;
        } elseif($group == 'client') {
            $groupid = Group::where('name', '=', 'Client')->first()->id;
        } else {
            abort(403);
        }

        // Check if we have multiple IDs to assign
        $idArray = explode(',', $idlist);
        foreach($idArray as $id) {
            $issue                 = $this->find($id);
            $issue->assigned_to_id = $groupid;
            $issue->claimed_by_id  = Auth::user()->id;
            $issue->save();
        }

        return true;
    }

    public function changeVersion($idlist, $version)
    {
        // Check if we have multiple IDs to assign
        $idArray = explode(',', $idlist);
        foreach($idArray as $id) {
            $issue          = $this->find($id);
            $issue->version = $version;
            $issue->save();
        }

        return true;
    }

    /*
     * Delete an issue
     */
    public function delete($idlist)
    {
        // Check if we have multiple IDs to destroy
        $idArray = explode(',', $idlist);
        foreach($idArray as $id) {
            $issue = Issue::find($id);
            $attachments = $issue->attachments()->get();
            foreach($attachments as $attachment) {
                $this->dispatch(new DestroyAttachmentCommand($attachment));
            }
            Issue::destroy($id);
        }
        return true;
    }

}