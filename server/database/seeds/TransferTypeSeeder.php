<?php

use App\transfer_type as transfer_type;
use Illuminate\Database\Seeder;

class TransferTypeSeeder extends Seeder{
	public function run(){
		transfer_type::truncate();
		transfer_type::create(["type"=>"Arrival"]);
		transfer_type::create(["type"=>"Departure"]);
	}
}
?>