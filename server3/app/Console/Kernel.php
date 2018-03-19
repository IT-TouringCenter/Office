<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Command: php artisan make:console DemoCron --command=demo:cron

 * how to config: config: * * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1
 * document: https://laravel.com/docs/5.0/artisan#scheduling-artisan-commands

 * document: https://laravel.com/docs/5.0/artisan#scheduling-artisan-commands
 * artisan development: https://laravel.com/docs/5.0/commands#introduction 
 */
class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
		'App\Console\Commands\Easybook\EmailCron',
		'App\Console\Commands\Easybook\TicketCron',
		'App\Console\Commands\Easybook\PaymentCron',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')->hourly();

		/* 
			config: * * * * * php /path/to/artisan schedule:run 1>> /dev/null 2>&1
			document: https://laravel.com/docs/5.0/artisan#scheduling-artisan-commands
		*/
		//*(min:0-59) *(hour:0-23) *(day of month:1-31) *(month:1-12) *(day of week:0-7)
		$schedule->command('email:notify')->cron('1 * * * *');//execute every minute
		$schedule->command('ticket:verify')->dailyAt('00:01');//daiy job
		$schedule->command('payment:verify')->dailyAt('00:01');//daiy job
	}

}
