<?php

use App\transaction_status as transaction_status;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder{
	public function run(){
		transaction_status::truncate();
		transaction_status::create(["status"=>"Pending"]);
		transaction_status::create(["status"=>"Paid"]);
		transaction_status::create(["status"=>"Cancel"]);
		transaction_status::create(["status"=>"Expired"]);
		transaction_status::create(["status"=>"Error"]);
	}
}
?>