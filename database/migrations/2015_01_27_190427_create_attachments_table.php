<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attachments', function(Blueprint $table)
		{
			$table->increments('id');
			// Issue ID
			$table->integer('issue_id')->unsigned();
			$table->foreign('issue_id')->references('id')->on('issues');
            // Author
            $table->integer('author_id')->unsigned()->nullable();
            $table->foreign('author_id')->references('id')->on('users');
			// Filename
			$table->string('filename');
			// Extension
			$table->string('extension');
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
		Schema::drop('attachments');
	}

}
