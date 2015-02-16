<?php namespace App\Handlers\Events;

use App\Events\AttachmentWasDeleted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class RemoveAzureBlob {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  AttachmentWasDeleted  $event
	 * @return void
	 */
	public function handle(AttachmentWasDeleted $event)
	{
		//
	}

}
