<?php namespace App\Console\Commands\Easybook;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class PaymentCron extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'payment:verify';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Verify payments still pending not paid yet. Execute every 00:01';

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
	public function handle()
	{
		try{
			\PaymentFacade::Verify('PaymentCron');
			$this->info('Verified payment command successfully!');
		}catch(\Exception $e){
			$this->error('Verified payment has somthing went wrong!');
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
