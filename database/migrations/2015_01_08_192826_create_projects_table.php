<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
            // Project name
			$table->string('name');
            // URI stub
			$table->string('stub');
            // Client
			$table->integer('client')->unsigned();
			$table->foreign('client')->references('id')->on('clients');
            // Project manager
            $table->integer('project_manager')->unsigned()->nullable();
            $table->foreign('project_manager')->references('id')->on('users');
            // Lead developer
            $table->integer('lead_developer')->unsigned()->nullable();
            $table->foreign('lead_developer')->references('id')->on('users');
            // Lead designer
            $table->integer('lead_designer')->unsigned()->nullable();
            $table->foreign('lead_designer')->references('id')->on('users');
            // Current version
			$table->string('current_version');
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
		Schema::drop('projects');
	}

}
