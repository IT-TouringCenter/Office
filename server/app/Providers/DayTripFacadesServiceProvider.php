<?php 
namespace App\Providers;

use App;
use App\Tours\DayTripClass as DayTripClass;
use App\Repositories\DayTripRepository as DayTripRepository;

use Illuminate\Support\ServiceProvider;

class DayTripFacadesServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		// App::bind('daytrip',function(){			
		// 	return new DayTripClass();
		// });
	}
}
