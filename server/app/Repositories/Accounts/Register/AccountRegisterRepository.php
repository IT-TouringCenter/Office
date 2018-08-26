<?php 
namespace App\Repositories\Accounts\Register;

use Carbon\Carbon;

class AccountRegisterRepository{

	public function __construct(){	}

	/*
		1. Save accounts table
		2. Save account profiles table
		3. Check email repeat
		4. Get account data
	*/

	// 1. Save accounts table
	public function InsertAccount($data){
		$result = \DB::table('accounts')->insertGetId($data);
		return $result;
	}

	// 2. Save account profiles table
	public function InsertAccountProfile($data){
		$result = \DB::table('account_profiles')->insertGetId($data);
		return $result;
	}

	// 3. Check email repeat
	public function CheckEmailRepeat($data){
		$result = \DB::table('accounts')->where('username',$data)->get();
		if($result){
			return false;
		}else{
			return true;
		}
	}

	// 4. Get account data
	public function GetAccountData($accountId){
		$result = \DB::table('accounts')->where('id',$accountId)->get();
		return $result;
	}

}