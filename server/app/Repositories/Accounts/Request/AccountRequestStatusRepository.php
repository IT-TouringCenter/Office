<?php 
namespace App\Repositories\Accounts\Request;

use Carbon\Carbon;

class AccountRequestStatusRepository{    

	public function __construct(){

	}

	/*
		1. Get account by token
	*/

	// 1. Get account by token
	public function GetAccountByToken($token){
		$result = \DB::table('accounts')
						->where('token',$token)
						->where('is_active',1)
						->get();
		return $result;
    }
    
    // 2. Get request type
    public function GetAccountRequestStatus(){
        $result = \DB::table('account_request_statuses')
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

}