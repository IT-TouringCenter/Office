<?php
namespace App\Repositories\Dashboard\Member\Account;

use Carbon\Carbon;

class MemberAccountProfileRepository{

	public function __construct(){

	}

    // 1. Get account by token
    public function GetAccountByToken($token){
        $result = \DB::table('accounts')
                        ->where('token',$token)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // 2. Get account profile by account_id
    public function GetAccountProfileByAccountId($accountId){
        $result = \DB::table('account_profiles as ap')
                        ->select('a.email','a.tel','ap.fullname','ap.birth','ap.id_number','ap.address','ap.nationality','ap.picture','ap.copy_id_card')
                        ->join('accounts as a','a.id','=','ap.account_id')
                        ->where('a.id',$accountId)
                        ->where('ap.account_id',$accountId)
                        ->where('ap.is_active',1)
                        ->get();
        return $result;
    }

}