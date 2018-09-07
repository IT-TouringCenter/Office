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
						// ->where('is_active')
						->get();
		return $result;
	}

	// 2. Check account (active)
	public function CheckAccountActive($username,$password){
		$result = \DB::table('accounts')
						->where('username',$username)
						->where('password',$password)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 3. Check login (active)
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

	// 4. Save login history
	public function SaveLoginHistory($data){
		$result = \DB::table('login_histories')
						->insertGetId($data);
		return $result;
	}

	// 5. Get account data
	public function GetAccountData($accountId){
		$result = \DB::table('accounts')
						->where('id',$accountId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 6. Get login data
	public function GetLoginData($loginId){
		$result = \DB::table('login_histories')
						->where('id',$loginId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 7. Force logout
	public function ForceLogout($accountId){
		$update = ['is_active'=>0];
		$result = \DB::table('login_histories')
						->where('account_id',$accountId)
						->where('is_active',1)
						->update($update);
		return $result;
	}

	// 8. Get login last id
	public function GetLoginLastId($accountId){
		$result = \DB::table('login_histories')
						->where('account_id',$accountId)
						->where('is_active',1)
						->orderBy('id','desc')
						->get();
		return $result[0]->id;
	}

	// 9. Update login history
	public function UpdateLoginHistory($data,$loginId,$dateTimeNow){
		$result = \DB::table('login_histories')
						->where('id',$loginId)
						->where('logout_code_expired','<',$dateTimeNow)
						->update($data);
		return $result;
	}

	// 10. Get account by token
	public function GetAccountByToken($token){
		$result = \DB::table('accounts')
						->where('token',$token)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 11. Get account login by token
	public function GetAccountLoginByToken($token){
		$result = \DB::table('login_histories')
						->where('token',$token)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 11. Auto logout all active
	public function AutoLogout($dateTimeNow){
		$data = [
			'logout_datetime'=>$dateTimeNow,
			'is_active'=>0
		];
		$result = \DB::table('login_histories')
						->where('logout_expired','<',$dateTimeNow)
						->where('is_active',1)
						->update($data);		
		return $result;
	}
}