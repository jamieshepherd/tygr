<?php namespace App\Handlers\Events;

use Mail;
use App\User;
use App\Events\UserWasCreated;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class EmailUserRegistration implements ShouldBeQueued {

	use InteractsWithQueue;

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
		$user = User::find($event->userId);

		Mail::send('emails.welcome', array(
			'name' => $user->name,
			'email' => $user->email,
			'password' => $event->password), function($message) use($user) {
				$message->to($user->email, $user->name)->subject('Welcome!');
			}
		);
	}

}
