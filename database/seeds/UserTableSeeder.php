<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        User::create(array(
            'name'     => 'Jamie Shepherd',
            'email'    => 'jamie.shepherd@outlook.com',
            'password' => Hash::make('password')
        ));
        User::create(array(
            'name'     => 'Alan Bourne',
            'email'    => 'alan.bourne@spongeuk.com',
            'password' => Hash::make('password')
        ));
    }

}