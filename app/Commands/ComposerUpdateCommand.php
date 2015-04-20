<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

use Composer\Console\Application;
use Composer\Command\UpdateCommand;
use Symfony\Component\Console\Input\ArrayInput;

class ComposerUpdateCommand extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;

    /**
     * Execute the command.
     *
     * @return void
    */
    public function handle()
    {
        //putenv('COMPOSER_HOME=' . __DIR__ . 'vendor/bin/composer');
        $input = new ArrayInput(array('command' => 'update'));
        $application = new Application();
        //$application->setAutoExit(false); // prevent `$application->run` method from exitting the script
        $application->run($input);
    }

}
