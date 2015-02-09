<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Client;

class TestClientTableSeeder extends Seeder {

    public function run()
    {
        Client::create(array(
            'name'    => 'Sponge UK',
            'stub'    => 'spongeuk',
            'type'    => 'Client'
        ));

        Client::create(array(
            'name'    => 'Blue Industries',
            'stub'    => 'blueindustries',
            'type'    => 'Client'
        ));

        Client::create(array(
            'name'    => 'Grey Software',
            'stub'    => 'greysoftware',
            'type'    => 'Client'
        ));

        Client::create(array(
            'name'    => 'Purple Pharmaceuticals',
            'stub'    => 'purplepharma',
            'type'    => 'Client'
        ));

        Client::create(array(
            'name'    => 'Orange Services',
            'stub'    => 'orangeservices',
            'type'    => 'Pitch'
        ));
    }

}
