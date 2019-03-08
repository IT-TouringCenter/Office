<?php

use App\account_type as account_type;
use Illuminate\Database\Seeder;

class AccountTypeSeeder extends Seeder{
	public function run(){
		account_type::truncate();
		account_type::create(["type"=>"User"]);
		account_type::create(["type"=>"Member"]);
		account_type::create(["type"=>"Affiliate"]);
		account_type::create(["type"=>"Admin"]);
		account_type::create(["type"=>"Manager"]);
		account_type::create(["type"=>"Reservation"]);
		account_type::create(["type"=>"Senior reservation"]);
		account_type::create(["type"=>"Sale"]);
		account_type::create(["type"=>"Online marketing"]);
		account_type::create(["type"=>"Accounting"]);
		account_type::create(["type"=>"Programer"]);
		account_type::create(["type"=>"Intern"]);
		account_type::create(["type"=>"Affiliate intern"]);
	}
}
?>