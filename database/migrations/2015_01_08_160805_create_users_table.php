<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            // Client association
			$table->integer('client')->unsigned();
			$table->foreign('client')->references('id')->on('clients');
            // Permissions level
			$table->integer('level');
            // Full name
			$table->string('name');
            // Email address
			$table->string('email')->unique();
            // Password
			$table->string('password', 60);
            // Remember me
			$table->rememberToken();
            // Timestamps
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
