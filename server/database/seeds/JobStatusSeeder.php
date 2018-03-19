<?php

use App\job_status as JobStatus;
use Illuminate\Database\Seeder;

class JobStatusSeeder extends Seeder{
	public function run(){
		JobStatus::truncate();
		JobStatus::create(["status"=>"Staff"]);
		JobStatus::create(["status"=>"Freelance"]);
	}
}
?>