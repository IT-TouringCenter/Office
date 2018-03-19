<?php

use App\payment_status as payment_status;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder{
	public function run(){
		payment_status::truncate();
		payment_status::create(["status"=>"Pending"]);
		payment_status::create(["status"=>"Paid"]);
		payment_status::create(["status"=>"Canceled"]);
		payment_status::create(["status"=>"Expired"]);
		payment_status::create(["status"=>"Error"]);
	}
}
?>