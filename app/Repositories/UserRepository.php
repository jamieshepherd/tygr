<?php namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;

use Hash;
use App\User;
use App\Events\UserWasCreated;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserRepository implements UserRepositoryInterface {

    /*
     * Retrieve all users
     *
     * @return  User
     */
    public function getAll()
    {
        return User::all();
    }

    /*
     * Find a specific user
     *
     * @param  int  $id
     *
     * @return  User
     */
    public function find($id)
    {
        return User::find($id);
    }

    /*
     * Create a new user
     *
     * @param  CreateUserRequest $request
     */
    public function create(CreateUserRequest $request)
    {
        $user = new User();
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->client_id = $request->client_id;
        $user->rank      = $request->rank;
        $user->password  = Hash::make($request->password);
        $result = $user->save();

        if($user->client_id == 1) {
            $user->attachToGroup('Sponge UK', $user->id);
        } else {
            $user->attachToGroup('Client', $user->id);
        }

        if($request->has('spongeuk_project_management'))
            $user->attachToGroup('Sponge UK (Project Management)', $user->id);

        if($request->has('spongeuk_development'))
            $user->attachToGroup('Sponge UK (Development)', $user->id);

        if($request->has('spongeuk_visual_design'))
            $user->attachToGroup('Sponge UK (Visual Design)', $user->id);

        if($request->has('spongeuk_instructional_design'))
            $user->attachToGroup('Sponge UK (Instructional Design)', $user->id);

        if($request->has('spongeuk_launch_and_learn'))
            $user->attachToGroup('Sponge UK (Launch & Learn)', $user->id);

        if($request->has('spongeuk_marketing'))
            $user->attachToGroup('Sponge UK (Marketing)', $user->id);

        if($request->has('spongeuk_human_resources'))
            $user->attachToGroup('Sponge UK (Human Resources)', $user->id);

        if($request->has('spongeuk_accounting'))
            $user->attachToGroup('Sponge UK (Accounting)', $user->id);

        if($request->has('spongeuk_administration'))
            $user->attachToGroup('Sponge UK (Administration)', $user->id);

        // Fire off a new user created event
        event(new UserWasCreated($user->id, $request->password));

        return $result;
    }

    /*
     * Update a user
     *
     * @param  int  $id
     * @param  UpdateUserRequest  $request
     */
    public function update($id, UpdateUserRequest $request) {
        $user            = $this->find($id);
        $user->name      = $request->name;
        $user->email     = $request->email;
        $user->client_id = $request->client_id;
        $user->rank      = $request->rank;

        // If the password field is not empty, change the password
        if($request->input('password')) {
            $user->password = Hash::make($request->password);
        }

        $result = $user->save();

        // Set and unset groups for the user if needed
        if($request->has('spongeuk_project_management')) {
            if(!$user->belongsToGroup('Sponge UK (Project Management)')) {
                $user->attachToGroup('Sponge UK (Project Management)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Project Management)',$user->id);
        }

        if($request->has('spongeuk_development')) {
            if(!$user->belongsToGroup('Sponge UK (Development)')) {
                $user->attachToGroup('Sponge UK (Development)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Development)',$user->id);
        }

        if($request->has('spongeuk_visual_design')) {
            if(!$user->belongsToGroup('Sponge UK (Visual Design)')) {
                $user->attachToGroup('Sponge UK (Visual Design)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Visual Design)',$user->id);
        }

        if($request->has('spongeuk_instructional_design')) {
            if(!$user->belongsToGroup('Sponge UK (Instructional Design)')) {
                $user->attachToGroup('Sponge UK (Instructional Design)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Instructional Design)',$user->id);
        }

        if($request->has('spongeuk_launch_and_learn')) {
            if(!$user->belongsToGroup('Sponge UK (Launch & Learn)')) {
                $user->attachToGroup('Sponge UK (Launch & Learn)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Launch & Learn)',$user->id);
        }

        if($request->has('spongeuk_marketing')) {
            if(!$user->belongsToGroup('Sponge UK (Marketing)')) {
                $user->attachToGroup('Sponge UK (Marketing)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Marketing)',$user->id);
        }

        if($request->has('spongeuk_human_resources')) {
            if(!$user->belongsToGroup('Sponge UK (Human Resources)')) {
                $user->attachToGroup('Sponge UK (Human Resources)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Human Resources)',$user->id);
        }

        if($request->has('spongeuk_accounting')) {
            if(!$user->belongsToGroup('Sponge UK (Accounting)')) {
                $user->attachToGroup('Sponge UK (Accounting)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Accounting)',$user->id);
        }

        if($request->has('spongeuk_administration')) {
            if(!$user->belongsToGroup('Sponge UK (Administration)')) {
                $user->attachToGroup('Sponge UK (Administration)',$user->id);
            }
        } else {
            $user->detachFromGroup('Sponge UK (Administration)',$user->id);
        }

        return $result;
    }

    /*
     * Delete a user
     */
    public function delete($id) {
        return User::destroy($id);
    }

}