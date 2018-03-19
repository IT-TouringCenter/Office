<?php

use App\payment_mode as payment_mode;
use Illuminate\Database\Seeder;

class PaymentModeSeeder extends Seeder{
	public function run(){
		payment_mode::truncate();
		payment_mode::create(["mode"=>"Selling price"]);
		payment_mode::create(["mode"=>"Local agent"]);
		payment_mode::create(["mode"=>"Local agent tax 3%"]);
		payment_mode::create(["mode"=>"BKK"]);
		payment_mode::create(["mode"=>"BKK tax 3%"]);
		payment_mode::create(["mode"=>"Discount"]);
	}
}
?>