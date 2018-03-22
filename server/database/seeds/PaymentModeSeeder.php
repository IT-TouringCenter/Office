<?php

use App\payment_mode as payment_mode;
use Illuminate\Database\Seeder;

class PaymentModeSeeder extends Seeder{
	public function run(){
		payment_mode::truncate();
		payment_mode::create(["mode"=>"Selling price","paper_color"=>"purple"]);
		payment_mode::create(["mode"=>"Local agent","paper_color"=>"pink"]);
		payment_mode::create(["mode"=>"Local agent tax 3%","paper_color"=>"yellow"]);
		payment_mode::create(["mode"=>"BKK","paper_color"=>"orenge"]);
		payment_mode::create(["mode"=>"BKK tax 3%","paper_color"=>"orenge"]);
		payment_mode::create(["mode"=>"Discount 15%","paper_color"=>"white"]);
		payment_mode::create(["mode"=>"Discount 20%","paper_color"=>"white"]);
		payment_mode::create(["mode"=>"Discount 25%","paper_color"=>"white"]);
		payment_mode::create(["mode"=>"Discount 30%","paper_color"=>"white"]);
		payment_mode::create(["mode"=>"Other","paper_color"=>"white"]);
	}
}
?>