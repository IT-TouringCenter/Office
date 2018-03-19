<?php
namespace App\Facades\Commons;

use Carbon\Carbon;

class HelperClass{
	
	public function Encode($value){
		$dt = Carbon::now();
		$encId = $dt.':'.$value;
		return base64_encode(strrev($encId));
	}
	
	public function Decode($value){
		$val = base64_decode($value);
		$val = strrev($val);
		$val_arr = explode(':',$val);
		return end($val_arr);
	}
	
	public function SetTicketNumberFormat($ticketNumber){
		$replacement = '-';
		$pattern= substr_replace($ticketNumber, $replacement, 4, 0);
		return substr_replace($pattern, $replacement, 10, 0);
	}
	
	public function GetPaypalConfiguration(){
		return [
            "paypalCgi"=>env("PAYPAL_CGI"),
		    "paypalId"=>env("PAYPAL_ID"),
		    "completeUrl"=>env("PAYPAL_COMPLETED_URL"),
		    "timeoutUrl"=>env("PAYPAL_TIMEOUT_URL"),
		    "cancelUrl"=>env("PAYPAL_CANCEL_URL"),
		    "notifyUrl"=>env("PAYPAL_NOTIFYURL")
        ];
	}

	public function GetURLAPIEmailPayer(){
		return env("API_PENDING_EMAIL_PAYER_URL");
	}

	public function ReserveIdentify($activityId){
        $result= \DB::select('select nst_fn_getIdentifies_reserveIdentifies ('.$activityId.') as id');
        return $result[0]->{'id'};
    }

    public function CheckUnique($data){
    	$data = array_map('json_encode', $data);
		$data = array_unique($data);
		$data = array_map('json_decode', $data);
		return $data;
    }

    public function GenerateTransactionNumber($data){
    	$data = str_pad($data,4,0,STR_PAD_LEFT);
    	return $data;
    }
}

?>