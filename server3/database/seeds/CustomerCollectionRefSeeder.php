<?php

use App\customer_collection_ref as CustomerCollectionRef;
use Illuminate\Database\Seeder;

class CustomerCollectionRefSeeder extends Seeder{
	public function run(){
		CustomerCollectionRef::truncate();
		CustomerCollectionRef::create(["id"=>"0","collection"=>"Not Active"]);
		CustomerCollectionRef::create(["id"=>"1","collection"=>"Net at Front (on travelling date)"]);
		CustomerCollectionRef::create(["id"=>"2","collection"=>"Selling Price at Guest (on travelling date)"]);
		CustomerCollectionRef::create(["id"=>"3","collection"=>"Voucher - Cash credit (1-15 days)"]);
		CustomerCollectionRef::create(["id"=>"4","collection"=>"Voucher - Cash credit (16-30 days)"]);
		CustomerCollectionRef::create(["id"=>"5","collection"=>"Voucher - Weekly Billing Credit 1-15 days"]);
		CustomerCollectionRef::create(["id"=>"6","collection"=>"Voucher - Weekly Billing Credit 16-30 days"]);
		CustomerCollectionRef::create(["id"=>"7","collection"=>"Voucher - 15 Days Billing Credit 1-15 days"]);
		CustomerCollectionRef::create(["id"=>"8","collection"=>"Voucher - Monthly Billing Credit 25-30 days"]);
		CustomerCollectionRef::create(["id"=>"9","collection"=>"Prepayment"]);
	}
}
?>