<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        User::create(array(
            'name'        => 'Jamie Shepherd',
            'client_id'   => 1,
            'rank'        => 1,
            'email'       => 'jamie.shepherd@spongeuk.com',
            'password'    => Hash::make('password')
        ));

        User::create(array(
            'name'        => 'Alan Bourne',
            'client_id'   => 1,
            'rank'        => 1,
            'email'       => 'alan.bourne@spongeuk.com',
            'password'    => Hash::make('password')
        ));

        User::create(array(
            'name'        => 'Alex Stewart',
            'client_id'   => 1,
            'rank'        => 1,
            'email'       => 'alex.stewart@spongeuk.com',
            'password'    => Hash::make('password')
        ));

        User::create(array(
            'name'        => 'Andrea Kinsman',
            'client_id'   => 1,
            'rank'        => 1,
            'email'       => 'andrea.kinsman@spongeuk.com',
            'password'    => Hash::make('password')
        ));
    }
}