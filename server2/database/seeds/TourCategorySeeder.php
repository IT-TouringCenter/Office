<?php

use App\tour_category as tour_category;
use Illuminate\Database\Seeder;

class TourCategorySeeder extends Seeder{
	public function run(){
		tour_category::truncate();
		tour_category::create(["category"=>"Sightseeing Tours"]);
		tour_category::create(["category"=>"Cultural Tours"]);
		tour_category::create(["category"=>"Elephant Tours"]);
		tour_category::create(["category"=>"Nature & Adventure Tours"]);
	}
}
?>