<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Client;

class ClientTableSeeder extends Seeder {

    public function run()
    {
        Client::create(array(
            'name'    => 'Sponge UK',
            'stub'    => 'spongeuk',
            'type'    => 'Client'
        ));
    }

}
