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
			$table->integer('client_id')->unsigned();
			$table->foreign('client_id')->references('id')->on('clients');
            // Project manager
            $table->integer('project_manager_id')->unsigned()->nullable();
            $table->foreign('project_manager_id')->references('id')->on('users');
            // Lead developer
            $table->integer('lead_developer_id')->unsigned()->nullable();
            $table->foreign('lead_developer_id')->references('id')->on('users');
            // Lead designer
            $table->integer('lead_designer_id')->unsigned()->nullable();
            $table->foreign('lead_designer_id')->references('id')->on('users');
            // Current version
			$table->string('current_version');
			// Project status
			$table->string('status');
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
