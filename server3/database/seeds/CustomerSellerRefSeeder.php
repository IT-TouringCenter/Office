<?php

use App\customer_seller_ref as CustomerSellerRef;
use Illuminate\Database\Seeder;

class CustomerSellerRefSeeder extends Seeder{
	public function run(){
		CustomerSellerRef::truncate();
		CustomerSellerRef::create(["id"=>"0","seller"=>"Direct from Client"]);
		CustomerSellerRef::create(["id"=>"1","seller"=>"Agent"]);
		CustomerSellerRef::create(["id"=>"2","seller"=>"Front"]);
		CustomerSellerRef::create(["id"=>"3","seller"=>"Concierge"]);
		CustomerSellerRef::create(["id"=>"4","seller"=>"Club Lounge"]);
		CustomerSellerRef::create(["id"=>"5","seller"=>"Bell Boy"]);
		CustomerSellerRef::create(["id"=>"6","seller"=>"Guide"]);
		CustomerSellerRef::create(["id"=>"7","seller"=>"Owner"]);
	}
}
?>