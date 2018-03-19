<?php

use App\customer_year_ref as CustomerYearRef;
use Illuminate\Database\Seeder;

class CustomerYearRefSeeder extends Seeder{
	public function run(){
		CustomerYearRef::truncate();
		CustomerYearRef::create(["id"=>"00","year"=>"ลูกค้าเก่าแก่"]);
		CustomerYearRef::create(["id"=>"14","year"=>"2014"]);
		CustomerYearRef::create(["id"=>"15","year"=>"2015"]);
		CustomerYearRef::create(["id"=>"16","year"=>"2016"]);
		CustomerYearRef::create(["id"=>"17","year"=>"2017"]);
		CustomerYearRef::create(["id"=>"18","year"=>"2018"]);
	}
}
?>