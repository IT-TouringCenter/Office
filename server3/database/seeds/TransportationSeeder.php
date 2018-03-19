<?php

use App\transportation as transportation;
use Illuminate\Database\Seeder;

class TransportationSeeder extends Seeder{
	public function run(){
		transportation::truncate();
		transportation::create(["transport"=>"Van"]);
		transportation::create(["transport"=>"Mercedes Benz E250"]);
		transportation::create(["transport"=>"Toyota Camry"]);
		transportation::create(["transport"=>"VIP - Van"]);
		transportation::create(["transport"=>"Bus"]);
	}
}
?>