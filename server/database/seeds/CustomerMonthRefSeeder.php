<?php

use App\customer_month_ref as CustomerMonthRef;
use Illuminate\Database\Seeder;

class CustomerMonthRefSeeder extends Seeder{
	public function run(){
		CustomerMonthRef::truncate();
		CustomerMonthRef::create(["id"=>"00","month"=>"ไม่ได้ระบุ"]);
		CustomerMonthRef::create(["id"=>"01","month"=>"Jan"]);
		CustomerMonthRef::create(["id"=>"02","month"=>"Feb"]);
		CustomerMonthRef::create(["id"=>"03","month"=>"Mar"]);
		CustomerMonthRef::create(["id"=>"04","month"=>"Apr"]);
		CustomerMonthRef::create(["id"=>"05","month"=>"May"]);
		CustomerMonthRef::create(["id"=>"06","month"=>"Jun"]);
		CustomerMonthRef::create(["id"=>"07","month"=>"Jul"]);
		CustomerMonthRef::create(["id"=>"08","month"=>"Aug"]);
		CustomerMonthRef::create(["id"=>"09","month"=>"Sep"]);
		CustomerMonthRef::create(["id"=>"10","month"=>"Oct"]);
		CustomerMonthRef::create(["id"=>"11","month"=>"Nov"]);
		CustomerMonthRef::create(["id"=>"12","month"=>"Dec"]);
	}
}
?>