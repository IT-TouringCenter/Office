<?php

use App\tour_privacy as tour_privacy;
use Illuminate\Database\Seeder;

class TourPrivacySeeder extends Seeder{
	public function run(){
		tour_privacy::truncate();
		tour_privacy::create(["privacy"=>"Join"]);
		tour_privacy::create(["privacy"=>"Private"]);
	}
}
?>