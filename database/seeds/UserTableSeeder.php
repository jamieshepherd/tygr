<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Client;

class UserTableSeeder extends Seeder {

    public function run()
    {
        $client = Client::where('name', '=', 'Sponge UK')->first()->id;

        User::create(array(
            'name'        => 'Jamie Shepherd',
            'client_id'   => $client,
            'rank'        => 1,
            'email'       => 'jamie.shepherd@spongeuk.com',
            'password'    => Hash::make('password')
        ));
    }
}