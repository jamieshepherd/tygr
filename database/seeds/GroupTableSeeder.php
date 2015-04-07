<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Group;

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

        Group::create(array(
            'name'        => 'Sponge UK (Launch & Learn)'
        ));

        Group::create(array(
            'name'        => 'Sponge UK (Marketing)'
        ));

        Group::create(array(
            'name'        => 'Sponge UK (Human Resources)'
        ));

        Group::create(array(
            'name'        => 'Sponge UK (Accounting)'
        ));

        Group::create(array(
            'name'        => 'Sponge UK (Administration)'
        ));
    }

}