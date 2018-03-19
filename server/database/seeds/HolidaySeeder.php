<?php

use App\holiday as holiday;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder{
	public function run(){
		holiday::truncate();
		holiday::create(["holiday"=>"New Year","period_start"=>"2018-12-31","period_end"=>"2019-01-01"]);
		holiday::create(["holiday"=>"New Year (Tour Doi)","period_start"=>"2018-12-30","period_end"=>"2019-01-02"]);
		holiday::create(["holiday"=>"Song Kran Thailand","period_start"=>"2018-04-13","period_end"=>"2018-04-15"]);
	}
}
?>