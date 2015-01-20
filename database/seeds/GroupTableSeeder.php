<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class GroupTableSeeder extends Seeder {

    public function run()
    {

        Group::create(array(
            'name'        => 'Client'
        ));

        Group::create(array(
            'name'        => 'Sponge UK'
        ));

        Group::create(array(
            'name'        => 'Sponge UK (Project Management)'
        ));

        Group::create(array(
            'name'        => 'Sponge UK (Development)'
        ));

        Group::create(array(
            'name'        => 'Sponge UK (Visual Design)'
        ));

        Group::create(array(
            'name'        => 'Sponge UK (Instructional Design)'
        ));
    }

}