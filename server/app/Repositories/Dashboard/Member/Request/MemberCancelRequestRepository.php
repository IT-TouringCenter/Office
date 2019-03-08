<?php
namespace App\Repositories\Dashboard\Member\Request;

use Carbon\Carbon;

class MemberCancelRequestRepository{

	public function __construct(){

	}

    // 1. Get account by token
    public function GetAccountByToken($token, $accountTypeId){
        $result = \DB::table('accounts')
                        ->where('token',$token)
                        ->where('account_type_id',$accountTypeId)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // 2. Get request
    public function CancelRequest($accountId, $requestId){
        $update = [
            'is_cancel'=>0,
            'is_active'=>0
        ];
        $result = \DB::table('account_requests')
                        ->where('id',$requestId)
                        ->where('account_id',$accountId)
                        ->where('is_active',1)
                        ->update($update);
        return $result;
    }

}