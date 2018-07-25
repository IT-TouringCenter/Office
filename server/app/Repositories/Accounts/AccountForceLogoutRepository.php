<?php 
namespace App\Repositories\Accounts;

use Carbon\Carbon;

class AccountForceLogoutRepository{    

	public function __construct(){

	}

	/*
		1. Get account
		2. Force logout
	*/

	// 1. Get account
	public function GetAccount($username){
		$result = \DB::table('accounts')
						->where('username',$username)
						->get();
		return $result;
	}

	// 2. Force logout
	public function ForceLogout($accountId, $logoutCode, $dateTimeNow){
		$update = ['is_active'=>0,'logout_datetime'=>$dateTimeNow];
		$result = \DB::table('login_histories')
						->where('account_id',$accountId)
						->where('logout_code',$logoutCode)
						->where('logout_code_expired','>',$dateTimeNow)
						->where('is_active',1)
						->update($update);
		return $result;
	}
}