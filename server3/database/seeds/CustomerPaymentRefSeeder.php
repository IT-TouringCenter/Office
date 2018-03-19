<?php

use App\customer_payment_ref as CustomerPaymentRef;
use Illuminate\Database\Seeder;

class CustomerPaymentRefSeeder extends Seeder{
	public function run(){
		CustomerPaymentRef::truncate();
		CustomerPaymentRef::create(["id"=>"0","payment"=>"Not Active"]);
		CustomerPaymentRef::create(["id"=>"1","payment"=>"Net Price (local)"]);
		CustomerPaymentRef::create(["id"=>"2","payment"=>"Net + 3%"]);
		CustomerPaymentRef::create(["id"=>"3","payment"=>"Selling Price"]);
		CustomerPaymentRef::create(["id"=>"4","payment"=>"Voucher"]);
		CustomerPaymentRef::create(["id"=>"5","payment"=>"Less 20% of selling price"]);
		CustomerPaymentRef::create(["id"=>"6","payment"=>"Paypal (issue by system)"]);
		CustomerPaymentRef::create(["id"=>"7","payment"=>"Paypal (issue by TC Office)"]);
		CustomerPaymentRef::create(["id"=>"8","payment"=>"Net Price (other country)"]);
	}
}
?>