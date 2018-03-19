<?php

use App\email_type as email_type;
use Illuminate\Database\Seeder;

class EmailTypeSeeder extends Seeder{
	public function run(){
		email_type::truncate();
		email_type::create(["type"=>"Reservation"]);
		email_type::create(["type"=>"Contact"]);
		email_type::create(["type"=>"Report"]);
		email_type::create(["type"=>"Download"]);
		email_type::create(["type"=>"Validity"]);
		email_type::create(["type"=>"Job Vacancy"]);
		email_type::create(["type"=>"Transfer"]);
		email_type::create(["type"=>"Developer"]);
	}
}
?>