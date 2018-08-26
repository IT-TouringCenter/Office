<?php 
namespace App\Repositories\Accounts\Register;

use Carbon\Carbon;

class AccountRegisterConfirmRepository{    

	public function __construct(){	}

	/*
		1. Check email & confirm expired
		2. Active account table
		3. Active account profile table
		4. Get account
		5. Get account data from token
	*/

	// 1. Check email & confirm expired
	public function CheckConfirmExpired($data,$dateNow){
		$result = \DB::table('accounts')
						->select('id')
						->where('username',array_get($data,'email'))
						->where('active_code',array_get($data,'registerCode'))
						->where('active_expired','>',$dateNow)
						->where('is_active',0)
						->get();
		if($result){
			return $result;
		}else{
			return false;
		}
	}

	// 2. Active account table
	public function ActiveAccount($accoutId,$dateNow){
		$update = ['is_active'=>1];
		$result = \DB::table('accounts')
						->where('id',$accoutId)
						->where('active_expired','>',$dateNow)
						->where('is_active',0)
						->update($update);
		if($result){
			return true;
		}else{
			return false;
		}
	}

	// 3. Active account profile table
	public function ActiveAccountProfile($accountId){
		$update = ['is_active'=>1];
		$result = \DB::table('account_profiles')
						->where('account_id',$accountId)
						->where('is_active',0)
						->update($update);
		if($result){
			return true;
		}else{
			return false;
		}
	}

	// 4. Get account data
	public function GetAccountData($accountId){
		$result = \DB::table('accounts')
						->where('id',$accountId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 5. Get account data from token
	public function GetAccountFromToken($token){
		// $tokens = 1196955109;
		$result = \DB::table('accounts')
						->where('token',$token)
						->where('is_active',0)
						->get();
		return $result;
	}

	// 6. Update confirm code by account id
	public function UpdateConfirmCodeByAccountId($accountId, $accountData){
		$result = \DB::table('accounts')
						->where('id', $accountId)
						->update($accountData);
		return $result;
	}
}