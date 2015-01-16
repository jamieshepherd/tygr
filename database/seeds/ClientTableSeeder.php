<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Client;

class ClientTableSeeder extends Seeder {

    public function run()
    {

        Client::create(array(
            'name'    => 'Sports Direct'
        ));

        Client::create(array(
            'name'    => 'Farmfoods'
        ));

        Client::create(array(
            'name'    => 'Toyota'
        ));
    }

}
