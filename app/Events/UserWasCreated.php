<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserWasCreated extends Event {

	use SerializesModels;

	public $userId;
	public $password;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($userId, $password)
	{
		$this->userId = $userId;
		$this->password = $password;
	}

}
