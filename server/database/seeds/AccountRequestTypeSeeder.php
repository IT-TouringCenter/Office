<?php

use App\account_request_type as account_request_type;
use Illuminate\Database\Seeder;

class AccountRequestTypeSeeder extends Seeder{
	public function run(){
		account_request_type::truncate();
        account_request_type::create(["type_th"=>"สมัครสมาชิก","type_en"=>"Register"]);
        account_request_type::create(["type_th"=>"สมัคร Affiliate","type_en"=>"Affiliate register"]);
        account_request_type::create(["type_th"=>"ลืมรหัสผ่าน","type_en"=>"Forgot password"]);
        account_request_type::create(["type_th"=>"ค่าคอมมิชชั่น","type_en"=>"Commission"]);
	}
}
?>