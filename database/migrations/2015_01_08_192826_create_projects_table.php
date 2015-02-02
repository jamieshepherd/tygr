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
			// Hidden from client
			$table->boolean('hidden');
            // Project name
			$table->string('name');
            // URI stub
			$table->string('stub');
            // Client
			$table->integer('client_id')->unsigned();
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            // Project manager
            // $table->integer('project_manager_id')->unsigned()->nullable();
            // $table->foreign('project_manager_id')->references('id')->on('users');
			$table->string('project_manager')->nullable();
            // Lead developer
            // $table->integer('lead_developer_id')->unsigned()->nullable();
            // $table->foreign('lead_developer_id')->references('id')->on('users');
			$table->string('lead_developer')->nullable();
            // Lead designer
            // $table->integer('lead_designer_id')->unsigned()->nullable();
            // $table->foreign('lead_designer_id')->references('id')->on('users');
			$table->string('lead_designer')->nullable();
			// Instructional designer
			// $table->integer('instructional_designer_id')->unsigned()->nullable();
			// $table->foreign('instructional_designer_id')->references('id')->on('users');
			$table->string('instructional_designer')->nullable();
            // Current version
			$table->string('current_version');
			// Project status
			$table->string('status');
			// Authoring tool
			$table->string('authoring_tool');
			// Deployment location (client or sponge)
			$table->string('lms_deployment');
			// LMS specification (SCORM)
			$table->string('lms_specification');
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
