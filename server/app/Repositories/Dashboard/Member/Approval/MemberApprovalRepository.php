<?php
namespace App\Repositories\Dashboard\Member\Approval;

use Carbon\Carbon;

class MemberApprovalRepository{

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
    public function GetRequest($accountId){
        $result = \DB::table('account_requests as ar')
                        ->select('ar.id','art.id as type_id','art.type_th','art.type_en','ars.id as status_id','ars.status_th','ars.status_en','ar.created_at')
                        ->join('account_request_types as art','art.id','=','ar.account_request_type_id')
                        ->join('account_request_statuses as ars','ars.id','=','ar.account_request_status_id')
                        ->where('ar.account_id',$accountId)
                        ->where('ar.is_cancel',0)
                        ->where('ar.is_active',1)
                        ->where('art.is_active',1)
                        ->where('ars.is_active',1)
                        ->get();
        return $result;
    }

}