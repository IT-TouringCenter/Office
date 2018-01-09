<?php
namespace App\Facades\EasyBook\Discount;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\EasyBook\Discount\DiscountCodeRepository as discount_code_repo;
use App\discount_code as discount_code;

class DiscountCodeClass{
	
	public function __construct(discount_code_repo $discount_code_repo){
		$this->discount_code_repo = $discount_code_repo;
	}

	public function SetDiscountCode(){
		$date_now = md5(Carbon::now('Asia/Bangkok'));
		$discount_code = strtoupper(substr($date_now, 0,12));

		$random_code = str_shuffle($discount_code);

		$expire_date = "2017-07-15 00:00:00";
		$result = $this->discount_code_repo->SetDiscountCodeForGetId($random_code,$expire_date);
		return $result;
	}

	public function SetDiscountCodeNoneActive(){
		$date_now = md5(Carbon::now('Asia/Bangkok'));
		$discount_code = strtoupper(substr($date_now, 0,12));

		$random_code = str_shuffle($discount_code);

		$expire_date = "2017-07-15 00:00:00";
		$is_active = 0; // Fixed for ICAS10 none
		$result = $this->discount_code_repo->SetDiscountCodeNoneActiveForGetId($random_code,$expire_date,$is_active);
		return $result;
	}

}