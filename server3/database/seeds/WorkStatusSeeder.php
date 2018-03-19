<?php

use App\work_status as work_status;
use Illuminate\Database\Seeder;

class WorkStatusSeeder extends Seeder{
	public function run(){
		work_status::truncate();
		work_status::create(["status"=>"Standby"]);
		work_status::create(["status"=>"Traveled"]);
		work_status::create(["status"=>"Locked"]);
		work_status::create(["status"=>"Busy"]);
	}
}
?>