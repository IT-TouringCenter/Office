<?php 
namespace App\Repositories\Accounts;

use Carbon\Carbon;

class AccountLogoutRepository{    

	public function __construct(){

	}

	/*
		1. Update login_histories (non active)
		2. Get account data
	*/

	// 1. Update login_histories (non active)
	public function Logout($accountId,$token,$dateTimeNow){
		$update = ['is_active'=>0,'logout_datetime'=>$dateTimeNow];
		$result = \DB::table('login_histories')
						->where('account_id',$accountId)
						->where('token',$token)
						->where('is_active',1)
						->update($update);
		return $result;
	}

	// 2. Get account data
	public function GetAccount($username){
		$result = \DB::table('accounts')
						->where('username',$username)
						->where('is_active',1)
						->get();
		return $result;
	}
}