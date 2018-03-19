<?php namespace App\Console\Commands\Easybook;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TicketCron extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'ticket:verify';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Verify each ticket of customer is expire or not.Execute daily job every 00:01';

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
	 * Document: https://laravel.com/docs/5.0/commands#introduction
	 * @return mixed
	 */
	public function handle()
	{
		try{
			\TicketFacade::Verify('TicketCron');
			$this->info('Verify ticket command run successfully!');
		}catch(\Exception $e){
			$this->error('Verify ticket command has something went wrong!');
		}
		
	}	
}
