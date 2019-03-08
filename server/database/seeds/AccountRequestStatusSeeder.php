<?php

use App\account_request_status as account_request_status;
use Illuminate\Database\Seeder;

class AccountRequestStatusSeeder extends Seeder{
	public function run(){
		account_request_status::truncate();
        account_request_status::create(["status_th"=>"รอการอนุมัติ", "status_en"=>"Waiting"]);
        account_request_status::create(["status_th"=>"อนุมัติแล้ว", "status_en"=>"Approved"]);
        account_request_status::create(["status_th"=>"ไม่ได้รับการอนุมัติ", "status_en"=>"Not approved"]);
	}
}
?>