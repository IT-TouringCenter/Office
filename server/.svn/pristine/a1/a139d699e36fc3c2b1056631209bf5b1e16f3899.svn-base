<?php
namespace App\Repositories\EasyBook\Discount;

use App\discount_code as discount_code;
use Carbon\Carbon;

class DiscountCodeRepository{

    public function __construct(discount_code $discount_code){
        $this->discount_code = $discount_code;
    }

    public function SetDiscountCodeForGetId($code, $expire_date){
    	$discount_code_arr = [
            'code'=>$code,
            'expire_date'=>$expire_date,
            'created_by'=>'System',
            'created_at'=>Carbon::now('Asia/Bangkok')
        ];
        // return $discount_code_arr;
    	$result = $this->discount_code->insertGetId($discount_code_arr); // Insert transaction table & Get Last Id
    	return $result;
    }

    public function SetDiscountCodeNoneActiveForGetId($code, $expire_date, $is_active){
        $discount_code_arr = [
            'code'=>$code,
            'expire_date'=>$expire_date,
            'is_active'=>$is_active,
            'created_by'=>'System',
            'created_at'=>Carbon::now('Asia/Bangkok')
        ];
        // return $discount_code_arr;
        $result = $this->discount_code->insertGetId($discount_code_arr); // Insert transaction table & Get Last Id
        return $result;
    }
}