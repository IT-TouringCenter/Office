<?php namespace App\Console\Commands\Easybook;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class EmailCron extends Command {

	/**
	 * The console command name.
	 * Reference: http://itsolutionstuff.com/post/example-of-cron-job-in-laravel-5example.html
	 * Command: php artisan make:console DemoCron --command=demo:cron
	 * @var string
	 */
	protected $name = 'email:notify';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Notify pending email to users. Execute every 1 minute';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	// public function fire()
	// {
	// 	$this->info('notify:cron command run successfully!');
	// }

	public function handle(){		
		try{
			\EmailFacade::SendPendingPaymentEmail();
			$this->info('Notify email command run successfully!');
		}catch(\Exception $e){
			$this->error('Notify email has somthing went wrong!');
		}
		
		
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	// protected function getArguments()
	// {
	// 	return [
	// 		['example', InputArgument::REQUIRED, 'An example argument.'],
	// 	];
	// }

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	// protected function getOptions()
	// {
	// 	return [
	// 		['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
	// 	];
	// }

}
