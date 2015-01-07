<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        User::create(array(
            'email'    => 'jamie.shepherd@outlook.com',
            'password' => Hash::make('password')
        ));
    }

}