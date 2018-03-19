<?php

use App\configuration_tour_holiday as configuration_tour_holiday;
use Illuminate\Database\Seeder;

class ConfigurationTourHolidaySeeder extends Seeder{
	public function run(){
		configuration_tour_holiday::truncate();
		configuration_tour_holiday::create(["tour_id"=>"1"]);
	}
}
?>