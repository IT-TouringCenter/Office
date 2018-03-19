<?php

use App\customer_type_ref as CustomerTypeRef;
use Illuminate\Database\Seeder;

class CustomerTypeRefSeeder extends Seeder{
	public function run(){
		CustomerTypeRef::truncate();
		CustomerTypeRef::create(["id"=>"0","type"=>"Government"]);
		CustomerTypeRef::create(["id"=>"1","type"=>"Travel Agent"]);
		CustomerTypeRef::create(["id"=>"2","type"=>"Hotel"]);
		CustomerTypeRef::create(["id"=>"3","type"=>"Guide"]);
		CustomerTypeRef::create(["id"=>"4","type"=>"Traveller | Tourist"]);
	}
}
?>