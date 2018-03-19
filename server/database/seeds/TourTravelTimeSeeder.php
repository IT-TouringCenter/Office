<?php

use App\tour_travel_time as tour_travel_time;
use Illuminate\Database\Seeder;

class TourTravelTimeSeeder extends Seeder{
	public function run(){
		tour_travel_time::truncate();
		tour_travel_time::create(["tour_id"=>"1","meridiem"=>"Morning","travel_time_start"=>"08:30 AM","travel_time_end"=>"12:00 PM","pickup_time"=>"08:00 AM"]);
		tour_travel_time::create(["tour_id"=>"1","meridiem"=>"Afternoon","travel_time_start"=>"01:30 PM","travel_time_end"=>"05:00 PM","pickup_time"=>"01:00 PM"]);
		tour_travel_time::create(["tour_id"=>"2","meridiem"=>"Morning","travel_time_start"=>"08:30 AM","travel_time_end"=>"12:00 PM","pickup_time"=>"08:00 AM"]);
		tour_travel_time::create(["tour_id"=>"2","meridiem"=>"Afternoon","travel_time_start"=>"01:30 PM","travel_time_end"=>"05:00 PM","pickup_time"=>"01:00 PM"]);
		tour_travel_time::create(["tour_id"=>"3","meridiem"=>"Morning","travel_time_start"=>"08:00 AM","travel_time_end"=>"12:00 AM","pickup_time"=>"07:30 AM"]);
		tour_travel_time::create(["tour_id"=>"3","meridiem"=>"Afternoon","travel_time_start"=>"12:30 PM","travel_time_end"=>"04:30 PM","pickup_time"=>"12:00 PM"]);
		tour_travel_time::create(["tour_id"=>"4","meridiem"=>"Morning","travel_time_start"=>"08:30 AM","travel_time_end"=>"12:00 PM","pickup_time"=>"08:00 AM"]);
		tour_travel_time::create(["tour_id"=>"4","meridiem"=>"Afternoon","travel_time_start"=>"01:30 PM","travel_time_end"=>"05:00 PM","pickup_time"=>"01:00 PM"]);
		tour_travel_time::create(["tour_id"=>"5","meridiem"=>"Afternoon","travel_time_start"=>"03:00 PM","travel_time_end"=>"07:30 PM","pickup_time"=>"02:30 PM"]);
		tour_travel_time::create(["tour_id"=>"6","meridiem"=>"Evening","travel_time_start"=>"06:30 PM","travel_time_end"=>"10:00 PM","pickup_time"=>"06:00 PM"]);
		tour_travel_time::create(["tour_id"=>"7","meridiem"=>"Evening","travel_time_start"=>"06:30 PM","travel_time_end"=>"10:00 PM","pickup_time"=>"06:00 PM"]);
		tour_travel_time::create(["tour_id"=>"8","meridiem"=>"Fullday","travel_time_start"=>"08:30 AM","travel_time_end"=>"04:30 PM","pickup_time"=>"08:00 AM"]);
		tour_travel_time::create(["tour_id"=>"9","meridiem"=>"Fullday","travel_time_start"=>"07:30 AM","travel_time_end"=>"08:00 PM","pickup_time"=>"07:00 AM"]);
		tour_travel_time::create(["tour_id"=>"10","meridiem"=>"Fullday","travel_time_start"=>"08:30 AM","travel_time_end"=>"05:00 PM","pickup_time"=>"08:00 AM"]);
		tour_travel_time::create(["tour_id"=>"11","meridiem"=>"Fullday","travel_time_start"=>"08:30 AM","travel_time_end"=>"05:00 PM","pickup_time"=>"08:00 AM"]);
		tour_travel_time::create(["tour_id"=>"12","meridiem"=>"Fullday","travel_time_start"=>"08:30 AM","travel_time_end"=>"04:30 PM","pickup_time"=>"08:00 AM"]);
		tour_travel_time::create(["tour_id"=>"13","meridiem"=>"Fullday","travel_time_start"=>"08:00 AM","travel_time_end"=>"02:30 PM","pickup_time"=>"07:30 AM"]);
		tour_travel_time::create(["tour_id"=>"14","meridiem"=>"Fullday","travel_time_start"=>"08:30 AM","travel_time_end"=>"05:00 PM","pickup_time"=>"08:00 AM"]);
		tour_travel_time::create(["tour_id"=>"15","meridiem"=>"Morning","travel_time_start"=>"08:00 AM","travel_time_end"=>"01:00 PM","pickup_time"=>"07:30 AM"]);
		tour_travel_time::create(["tour_id"=>"16","meridiem"=>"Afternoon","travel_time_start"=>"02:00 PM","travel_time_end"=>"07:00 PM","pickup_time"=>"01:30 PM"]);
		tour_travel_time::create(["tour_id"=>"17","meridiem"=>"Morning","travel_time_start"=>"08:00 AM","travel_time_end"=>"12:00 PM","pickup_time"=>"-"]);
		tour_travel_time::create(["tour_id"=>"18","meridiem"=>"Afternoon","travel_time_start"=>"01:30 PM","travel_time_end"=>"06:00 PM","pickup_time"=>"-"]);
	}
}
?>