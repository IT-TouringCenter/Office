<?php 
namespace App\Repositories\Accounts;

use Carbon\Carbon;

class AccountLoginRepository{    

	public function __construct(){

	}

	/*
		1. Check account
		2. Check account (active)
		3. Check login (active)
		4. Save login history
		5. Get account data
		6. Get login data
		7. Force logout
		8. Get login last id
		9. Update login history
		10. Get account by token
		11. Get account login by token
		12. Auto logout all active
		13. Get account type
	*/

	// 1. Check account
	public function CheckAccount($username,$password){
		$result = \DB::table('accounts')
						->where('username',$username)
						->where('password',$password)
						->where('is_delete',0)
						// ->where('is_active')
						->get();
		return $result;
	}

	// 2. Check account (active)
	public function CheckAccountActive($username,$password){
		$result = \DB::table('accounts')
						->where('username',$username)
						->where('password',$password)
						->where('is_delete',0)
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
						->where('is_delete',0)
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
						->where('is_delete',0)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 11. Get account login by token
	public function GetAccountLoginByToken($token,$tokenLogin){
		$result = \DB::table('login_histories')
						->where('token',$token)
						->where('token_login',$tokenLogin)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 12. Auto logout all active
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

	// 13. Get account type
	public function GetAccountType($token,$accountTypeId){
		$result = \DB::table('accounts as a')
						->select('at.type')
						->join('account_types as at','at.id','=','a.account_type_id')
						->where('a.token',$token)
						->where('a.account_type_id',$accountTypeId)
						->where('a.is_delete',0)
						->where('a.is_active',1)
						->where('at.is_active',1)
						->get();
		return $result;
	}

	// 14. Check login expried
	public function CheckLoginExpired($token, $date){
		$result = \DB::table('login_histories')
						->where('token',$token)
						->where('logout_expired','>',$date)
						->where('is_active',1)
						->get();
		return $result;
	}

	// 15. Get token login by id : login_histories
	public function GetLoginhistoryById($loginId){
		$result = \DB::table('login_histories')
						->where('id',$loginId)
						->where('is_active','=',1)
						->get();
		return $result;
	}

}