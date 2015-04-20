<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesCommands;
use App\Commands\ComposerUpdateCommand;

class SystemController extends Controller {

    use DispatchesCommands;

	/**
	 * Show the system settings
	 *
	 * @return Response
	 */
	public function show()
	{
		return view('system.show');
	}

    /**
     * Run a command
     *
     * @param $command
     * @return Response
     */
    public function run($command)
    {
        switch($command) {
            case "composer-update":
                $this->dispatch(new ComposerUpdateCommand());
                break;
            default:
                break;
        }
        \Session::flash('message', 'Command was executed.');
        return redirect('/system');
    }

}
