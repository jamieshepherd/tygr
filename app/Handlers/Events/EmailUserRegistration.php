<?php namespace App\Handlers\Events;

use App\Events\UserWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailUserRegistration {

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
	 * @param  UserWasCreated  $event
	 * @return void
	 */
	public function handle(UserWasCreated $event)
	{
		//
	}

}
