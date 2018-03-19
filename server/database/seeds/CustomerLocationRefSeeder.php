<?php

use App\customer_location_ref as customer_location_ref;
use Illuminate\Database\Seeder;

class CustomerLocationRefSeeder extends Seeder{
	public function run(){
		customer_location_ref::truncate();
		customer_location_ref::create(["id"=>"100","location"=>"Internet","continent"=>""]);
		customer_location_ref::create(["id"=>"101","location"=>"Chiang Mai","continent"=>"Thailand"]);
		customer_location_ref::create(["id"=>"102","location"=>"Bangkok","continent"=>"Thailand"]);
		customer_location_ref::create(["id"=>"103","location"=>"Phuket","continent"=>"Thailand"]);
		customer_location_ref::create(["id"=>"104","location"=>"Krabi","continent"=>"Thailand"]);
		customer_location_ref::create(["id"=>"105","location"=>"Other in TH","continent"=>"Thailand"]);
		customer_location_ref::create(["id"=>"200","location"=>"Other in Asia","continent"=>"Asia"]);
		customer_location_ref::create(["id"=>"201","location"=>"Singapore","continent"=>"Asia"]);
		customer_location_ref::create(["id"=>"202","location"=>"Malaysia","continent"=>"Asia"]);
		customer_location_ref::create(["id"=>"203","location"=>"Cambodia","continent"=>"Asia"]);
		customer_location_ref::create(["id"=>"204","location"=>"Hongkong","continent"=>"Asia"]);
		customer_location_ref::create(["id"=>"205","location"=>"Philippine","continent"=>"Asia"]);
		customer_location_ref::create(["id"=>"206","location"=>"Myanmar","continent"=>"Asia"]);
		customer_location_ref::create(["id"=>"207","location"=>"Vietnam","continent"=>"Asia"]);
		customer_location_ref::create(["id"=>"208","location"=>"Laos","continent"=>"Asia"]);
		customer_location_ref::create(["id"=>"301","location"=>"Sweden","continent"=>"Eulope"]);
		customer_location_ref::create(["id"=>"302","location"=>"Germany","continent"=>"Eulope"]);
		customer_location_ref::create(["id"=>"303","location"=>"France","continent"=>"Eulope"]);
		customer_location_ref::create(["id"=>"401","location"=>"Australia","continent"=>"Australia"]);
		customer_location_ref::create(["id"=>"502","location"=>"New zealand","continent"=>"New Zealand"]);
	}
}
?>