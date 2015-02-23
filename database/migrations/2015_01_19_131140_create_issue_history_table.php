<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssueHistoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('issue_history', function(Blueprint $table)
		{
			$table->increments('id');
            // Hidden from client
            $table->boolean('hidden')->default(false);
			// Issue ID
			$table->integer('issue_id')->unsigned();
			$table->foreign('issue_id')->references('id')->on('issues')->onDelete('cascade');
			// Author
			$table->integer('author_id')->unsigned();
			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
			// History type
			$table->string('type');
			// History status
			$table->string('status')->nullable();
			// History comment
			$table->text('comment');
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
		Schema::drop('issue_history');
	}

}
