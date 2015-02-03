<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class GroupUserTableSeeder extends Seeder {

    public function run()
    {

        // Jamie Shepherd
        $user = User::find(1);
        $user->groups()->sync([2,4]);

        // Alan Bourne
        $user = User::find(2);
        $user->groups()->sync([2,4]);

        // Alex Stewart
        $user = User::find(2);
        $user->groups()->sync([2,5]);

        // Andrea Kinsman
        $user = User::find(2);
        $user->groups()->sync([2,3]);
    }

}