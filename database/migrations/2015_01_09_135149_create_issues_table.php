<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('issues', function(Blueprint $table)
		{
			$table->increments('id');
			// Hidden from client
			$table->boolean('hidden');
            // Author
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            // Assigned to a group
			$table->integer('assigned_to_id')->unsigned();
			$table->foreign('assigned_to_id')->references('id')->on('groups')->onDelete('cascade');
			// Claimed by user
			$table->integer('claimed_by_id')->unsigned()->nullable();
			$table->foreign('claimed_by_id')->references('id')->on('users')->onDelete('set null');
            // Project
			$table->integer('project_id')->unsigned();
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            // Project version
			$table->string('version');
            // Page reference
			$table->string('reference');
            // Issue type
			$table->string('summary');
            // Description
			$table->text('description');
            // Status
			$table->string('status');
            // Priority
			$table->string('priority');
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
		Schema::drop('issues');
	}

}
