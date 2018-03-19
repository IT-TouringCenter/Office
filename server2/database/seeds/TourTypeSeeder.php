<?php

use App\tour_type as tour_type;
use Illuminate\Database\Seeder;

class TourTypeSeeder extends Seeder{
	public function run(){
		tour_type::truncate();
		tour_type::create(["type"=>"Daytrip"]);
		tour_type::create(["type"=>"Package"]);
	}
}
?>