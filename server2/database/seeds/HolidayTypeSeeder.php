<?php

use App\holiday_type as holiday_type;
use Illuminate\Database\Seeder;

class HolidayTypeSeeder extends Seeder{
	public function run(){
		holiday_type::truncate();
		holiday_type::create(["type"=>"Holiday"]);
		holiday_type::create(["type"=>"Accident"]);
	}
}
?>