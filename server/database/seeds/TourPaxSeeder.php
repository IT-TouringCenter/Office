<?php

use App\tour_pax as tour_pax;
use Illuminate\Database\Seeder;

class TourPaxSeeder extends Seeder{
	public function run(){
		tour_pax::truncate();
		tour_pax::create(["min_pax"=>"2","max_pax"=>"3"]);
		tour_pax::create(["min_pax"=>"4","max_pax"=>"5"]);
		tour_pax::create(["min_pax"=>"6","max_pax"=>"9"]);
		tour_pax::create(["min_pax"=>"1","max_pax"=>"9"]);
	}
}
?>