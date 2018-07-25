<?php 
namespace App\Repositories\Accounts\Setting;

use Carbon\Carbon;

class AccountResetPasswordRepository{

	public function __construct(){

	}

	/*
		1. Get account
		2. Get account request
		3. Reset password
		4. Non active request
		5. Force logout
		6. Cancel request
	*/
	
	// 1. Get account
	public function GetAccount($email){
		$result = \DB::table('accounts')
						->where('email',$email)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 2. Get account request
	public function GetAccountRequest($accountId, $requestTypeId, $requestCode, $dateTimeNow){
		$result = \DB::table('account_requests')
						->where('account_id',$accountId)
						->where('account_request_type_id',$requestTypeId)
						->where('request_code',$requestCode)
						->where('request_code_expired','>',$dateTimeNow)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 3. Reset password
	public function ResetPassword($accountId, $password){
		$update = ['password'=>$password];
		$result = \DB::table('accounts')
						->where('id',$accountId)
						->where('is_active',1)
						->update($update);
		return $result;
	}

	// 4. Non active request
	public function NonActiveRequest($accountId, $requestTypeId, $requestCode){
		$update = ['is_active'=>0];
		$result = \DB::table('account_requests')
						->where('account_id',$accountId)
						->where('account_request_type_id',$requestTypeId)
						->where('request_code',$requestCode)
						->update($update);
		return $result;
	}

	// 5. Force logout
	public function ForceLogout($accountId, $dateTimeNow){
		$update = ['is_active'=>0, 'logout_datetime'=>$dateTimeNow];
		$result = \DB::table('login_histories')
						->where('account_id',$accountId)
						->update($update);
		return $result;
	}

	// 6. Cancel request
	public function CancelRequest($accountId, $requestTypeId){
		$update = ['is_active'=>0];
		$result = \DB::table('account_requests')
						->where('account_id',$accountId)
						->where('account_request_type_id',$requestTypeId)
						->update($update);
		return $result;
	}
}