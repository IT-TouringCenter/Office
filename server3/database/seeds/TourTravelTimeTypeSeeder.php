<?php

use App\tour_travel_time_type as tour_travel_time_type;
use Illuminate\Database\Seeder;

class TourTravelTimeTypeSeeder extends Seeder{
	public function run(){
		tour_travel_time_type::truncate();
		tour_travel_time_type::create(["travel_time_type"=>"Half Day"]);
		tour_travel_time_type::create(["travel_time_type"=>"Full Day"]);
		tour_travel_time_type::create(["travel_time_type"=>"Evening Trip"]);
		tour_travel_time_type::create(["travel_time_type"=>"Seasonal Program"]);
	}
}
?>