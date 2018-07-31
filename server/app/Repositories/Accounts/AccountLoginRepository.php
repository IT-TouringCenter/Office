<?php 
namespace App\Repositories\Accounts;

use Carbon\Carbon;

class AccountLoginRepository{    

	public function __construct(){

	}

	/*
		1. Check account
		2. Check login (active)
		3. Save login history
		4. Get account data
		5. Get login data
		6. Force logout
		7. Get login last id
		8. Update login history
	*/

	// 1. Check account
	public function CheckAccount($username,$password){
		$result = \DB::table('accounts')
						->where('username',$username)
						->where('password',$password)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 2. Check login (active)
	public function CheckLoginStatus($accountId){
		$result = \DB::table('login_histories')
						->where('account_id',$accountId)
						->where('is_active',1)
						->get();
		if($result){
			return true;
		}else{
			return false;
		}
	}

	// 3. Save login history
	public function SaveLoginHistory($data){
		$result = \DB::table('login_histories')
						->insertGetId($data);
		return $result;
	}

	// 4. Get account data
	public function GetAccountData($accountId){
		$result = \DB::table('accounts')
						->where('id',$accountId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 5. Get login data
	public function GetLoginData($loginId){
		$result = \DB::table('login_histories')
						->where('id',$loginId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 6. Force logout
	public function ForceLogout($accountId){
		$update = ['is_active'=>0];
		$result = \DB::table('login_histories')
						->where('account_id',$accountId)
						->where('is_active',1)
						->update($update);
		return $result;
	}

	// 7. Get login last id
	public function GetLoginLastId($accountId){
		$result = \DB::table('login_histories')
						->where('account_id',$accountId)
						->where('is_active',1)
						->orderBy('id','desc')
						->get();
		return $result[0]->id;
	}

	// 8. Update login history
	public function UpdateLoginHistory($data,$loginId,$dateTimeNow){
		$result = \DB::table('login_histories')
						->where('id',$loginId)
						->where('logout_code_expired','<',$dateTimeNow)
						->update($data);
		return $result;
	}
}