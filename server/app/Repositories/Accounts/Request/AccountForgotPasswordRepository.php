<?php 
namespace App\Repositories\Accounts\Request;

use Carbon\Carbon;

class AccountForgotPasswordRepository{    

	public function __construct(){

	}

	/*
		1. Get account data
		2. Save account request
		3. Get request data
		4. Non active account request
	*/

	// 1. Get account data
	public function GetAccountData($email){
		$result = \DB::table('accounts')
						->where('email',$email)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 2. Save account request
	public function SaveAccountRequest($data){
		$result = \DB::table('account_requests')
						->insertGetId($data);
		return $result;
	}

	// 3. Get request data
	public function GetRequestData($requestId){
		$result = \DB::table('account_requests')
						->where('id',$requestId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 4. Non active account request
	public function NonActiveRequest($accountId, $requestTypeId){
		$update = ['is_active'=>0];
		$result = \DB::table('account_requests')
						->where('account_id',$accountId)
						->where('account_request_type_id',$requestTypeId)
						->update($update);
		return $result;
	}
}