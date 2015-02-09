<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class TestGroupUserTableSeeder extends Seeder {

    public function run()
    {

        // Jamie Shepherd
        $user = User::find(1);
        $user->groups()->sync([2,4]);

        // Andrea Kinsman
        $user = User::find(2);
        $user->groups()->sync([2,3]);

        // Andrea Kinsman
        $user = User::find(3);
        $user->groups()->sync([2,5]);

        // Tom Stembridge
        $user = User::find(4);
        $user->groups()->sync([2,4]);

        // Test user
        $user = User::find(5);
        $user->groups()->sync([1]);

        // Test user
        $user = User::find(6);
        $user->groups()->sync([2,6]);
    }

}