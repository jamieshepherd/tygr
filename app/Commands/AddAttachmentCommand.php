<?php namespace App\Commands;

use App\Commands\Command;
use App\Attachment;
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
		// make a random file prefix
		do { $unique = base_convert(rand(1,100000000),10,36);
		} while(file_exists('uploads/'.$this->issue.'/'.$unique.'-'.$this->file->getClientOriginalName()));
		// move the file to uploads
		$this->file->move('uploads/'.$this->issue.'/', $unique.'-'.$this->file->getClientOriginalName());
		// add an Attachment entry to the database, assign it our issue id
		$attachment = new Attachment();
		$attachment->issue_id = $this->issue;
		$attachment->filename = $unique.'-'.$this->file->getClientOriginalName();
		$attachment->save();
	}

}
