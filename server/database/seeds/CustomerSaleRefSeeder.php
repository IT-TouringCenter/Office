<?php

use App\customer_sale_ref as CustomerSaleRef;
use Illuminate\Database\Seeder;

class CustomerSaleRefSeeder extends Seeder{
	public function run(){
		CustomerSaleRef::truncate();
		CustomerSaleRef::create(["id"=>"00","sale"=>"Office (no sales)"]);
		CustomerSaleRef::create(["id"=>"01","sale"=>"Chock"]);
		CustomerSaleRef::create(["id"=>"02","sale"=>"Foog"]);
	}
}
?>