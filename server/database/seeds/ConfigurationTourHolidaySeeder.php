<?php

// use App\configuration_email as configuration_email;
use App\configuration_tour_holiday as ConfigTourHoliday;
use Illuminate\Database\Seeder;

class ConfigurationTourHolidaySeeder extends Seeder{
	public function run(){
		ConfigTourHoliday::truncate();
		ConfigTourHoliday::create(["tour_id"=>"1","holiday_id"=>"2","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"2","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"3","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"4","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"5","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"6","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"7","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"8","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"9","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"10","holiday_id"=>"2","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"11","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"12","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"13","holiday_id"=>"2","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"14","holiday_id"=>"2","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"15","holiday_id"=>"2","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"16","holiday_id"=>"2","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"17","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"18","holiday_id"=>"1","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"1","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"2","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"3","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"4","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"5","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"6","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"7","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"8","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"9","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"10","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"11","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"12","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"13","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"14","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"15","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"16","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"17","holiday_id"=>"3","holiday_type_id"=>"1"]);
		ConfigTourHoliday::create(["tour_id"=>"18","holiday_id"=>"3","holiday_type_id"=>"1"]);
	}
}
?>