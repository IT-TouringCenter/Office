<?php

use App\tour as tour;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder{
	public function run(){
		tour::truncate();
		tour::create(["code"=>"TC-01","title"=>"Doi Suthep Temple & Hmong Hill Tribe Village","short_description"=>"","long_description"=>"","period_start"=>"2018-01-01","period_end"=>"2018-10-31","is_recommend"=>"1"]);
		tour::create(["code"=>"TC-02","title"=>"City Temple & Museum","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"TC-03","title"=>"Elephant at Work & Ride @ Mae Sa Elephant Camp","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"TC-04","title"=>"Handicraft Village","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"TC-05A","title"=>"Chiang Mai Night Safari (Afternoon Trip; Day Safary)","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"TC-05E","title"=>"Chiang Mai Night Safari (Evening Trip)","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"1"]);
		tour::create(["code"=>"TC-06","title"=>"Khan Toke Dinner with Cultural Performances","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"TC-07","title"=>"Elephant Safari @ Mae Taman Elephant Camp","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"TC-08","title"=>"Chiang Rai Day Trip","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"1"]);
		tour::create(["code"=>"TC-09","title"=>"Inthanon National Park","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"TC-10","title"=>"Elephant Trek to Long Neck and Tiger Kingdom","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"1"]);
		tour::create(["code"=>"TC-11","title"=>"Elephant Conservation Center @ Lampang","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"1"]);
		tour::create(["code"=>"TC-12","title"=>"Trekking Doi Suthep Area","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"1"]);
		tour::create(["code"=>"TC-S01","title"=>"Kiew Mae Pan Natural Trail","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"TC-S02M","title"=>"Breath of Nature (Morning)","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"TC-S02A","title"=>"Breath of Nature (Afternoon)","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"1"]);
		tour::create(["code"=>"GYG-01","title"=>"Wat Umong + Wat Doi Suthep (Morning Trip; Dailay Operate Tour Code GYG-01)","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"GYG-02","title"=>"Monk Chat @ Wat Umong with Evening Market Tour (Afternoon Trip; Sunday Only Tour Code GYG-02)","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
		tour::create(["code"=>"-","title"=>"Chiang Dao Day Trip","short_description"=>"","long_description"=>"","period_start"=>"2018-01-02","period_end"=>"2018-10-31","is_recommend"=>"0"]);
	}
}
?>