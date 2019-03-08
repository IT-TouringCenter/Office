<?php
namespace App\Repositories\Dashboard\Member\Request;

use Carbon\Carbon;

class MemberCheckRequestJoinAffiliateRepository{

	public function __construct(){

	}

    // 1. Get account by token
    public function GetAccountByToken($token,$accountTypeId){
        $result = \DB::table('accounts')
                        ->where('token',$token)
                        ->where('account_type_id',$accountTypeId)
                        ->where('is_block_affiliate',0)
                        ->where('is_delete',0)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // 2. Check request affiliate
    public function CheckRequestAffiliate($accountId, $requestTypeId){
        $result = \DB::table('account_requests')
                        ->where('account_id',$accountId)
                        ->where('account_request_type_id',$requestTypeId)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // 3. Non active request affiliate : account_requests
    public function NonActiveRequestAffiliate($requestId, $accountId, $requestTypeId){
        $update = ['is_active'=>0];
        $result = \DB::table('account_requests')
                        ->where('id','!=',$requestId)
                        ->where('account_id',$accountId)
                        ->where('account_request_type_id',$requestTypeId)
                        ->where('is_active',1)
                        ->update($update);
        return $result;
    }

}