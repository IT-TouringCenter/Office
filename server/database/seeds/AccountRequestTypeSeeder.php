<?php

use App\account_request_type as account_request_type;
use Illuminate\Database\Seeder;

class AccountRequestTypeSeeder extends Seeder{
	public function run(){
		account_request_type::truncate();
        account_request_type::create(["type"=>"Register"]);
        account_request_type::create(["type"=>"Affiliate register"]);
        account_request_type::create(["type"=>"Forgot password"]);
        account_request_type::create(["type"=>"Commission"]);
	}
}
?>