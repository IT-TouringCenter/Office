<?php

use App\transaction_status as transaction_status;
use Illuminate\Database\Seeder;

class TransactionStatusSeeder extends Seeder{
	public function run(){
		transaction_status::truncate();
		transaction_status::create(["status"=>"Standby"]);
		transaction_status::create(["status"=>"Traveled"]);
		transaction_status::create(["status"=>"Locked"]);
		transaction_status::create(["status"=>"Busy"]);
	}
}
?>