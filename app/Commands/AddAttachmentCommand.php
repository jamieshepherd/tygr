<?php namespace App\Commands;

use App\Commands\Command;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Input;

class AddAttachmentCommand extends Command implements SelfHandling {

	public $file;
	public $issue;

	/**
	 * Create a new command instance.
	 *
	 * @param  object  $file
	 * @param  int  $issue
	 */
	public function __construct($file, $issue)
	{
		$this->file = $file;
		$this->issue = $issue;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		// move the file to uploads
		$this->file->move('uploads/');
		// give it a reasonable name
		// * we can use $this->file->getClientOriginalExtension()
		// add an Attachment entry to the database, assign it our issue id
	}

}
