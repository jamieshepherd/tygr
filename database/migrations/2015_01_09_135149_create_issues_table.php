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
			$table->integer('author')->unsigned();
			$table->foreign('author')->references('id')->on('users');
			$table->integer('assigned_to')->unsigned();
			$table->foreign('assigned_to')->references('id')->on('users');
			$table->integer('project')->unsigned();
			$table->foreign('project')->references('id')->on('projects');
			$table->string('version');
			$table->string('reference');
			$table->string('type');
			$table->text('description');
			$table->string('status');
			$table->string('priority');
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
