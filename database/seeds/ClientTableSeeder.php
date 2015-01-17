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

        Client::create(array(
            'name'    => 'Sports Direct',
            'stub'    => 'sportsdirect',
            'type'    => 'Client'
        ));

        Client::create(array(
            'name'    => 'Farmfoods',
            'stub'    => 'farmfoods',
            'type'    => 'Client'
        ));

        Client::create(array(
            'name'    => 'Toyota',
            'stub'    => 'toyota',
            'type'    => 'Client'
        ));

        Client::create(array(
            'name'    => 'Microsoft',
            'stub'    => 'microsoft',
            'type'    => 'Pitch'
        ));
    }

}
