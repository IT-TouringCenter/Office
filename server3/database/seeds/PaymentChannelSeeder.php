<?php

use App\payment_channel as PaymentChannel;
use Illuminate\Database\Seeder;

class PaymentChannelSeeder extends Seeder{
	public function run(){
		PaymentChannel::truncate();
		PaymentChannel::create(["channel"=>"Paypal"]);
		PaymentChannel::create(["channel"=>"Credit card"]);
		PaymentChannel::create(["channel"=>"Visa"]);
		PaymentChannel::create(["channel"=>"Cash"]);
		PaymentChannel::create(["channel"=>"Voucher"]);
	}
}
?>