<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        User::create(array(
            'name'        => 'Jamie Shepherd',
            'client'   => 1,
            'level'       => 1,
            'email'       => 'jamie.shepherd@spongeuk.com',
            'password'    => Hash::make('password')
        ));

        User::create(array(
            'name'        => 'Andrea Kinsman',
            'client'   => 1,
            'level'       => 1,
            'email'       => 'andrea.kinsman@spongeuk.com',
            'password'    => Hash::make('password')
        ));

        User::create(array(
            'name'        => 'Alex Stewart',
            'client'   => 1,
            'level'       => 2,
            'email'       => 'alex.stewart@spongeuk.com',
            'password'    => Hash::make('password')
        ));

        User::create(array(
            'name'        => 'Test User',
            'client'   => 2,
            'level'       => 3,
            'email'       => 'test@user.com',
            'password'    => Hash::make('password')
        ));
    }

}