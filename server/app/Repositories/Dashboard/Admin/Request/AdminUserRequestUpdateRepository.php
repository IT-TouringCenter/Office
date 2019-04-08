<?php 
namespace App\Repositories\Dashboard\Admin\Request;

class AdminUserRequestUpdateRepository{

	public function __construct(){

    }

    // 1. Get account by token
    public function GetAccountByToken($token){
        $result = \DB::table('accounts')
                    ->where('token',$token)
                    ->where('is_delete',0)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // 2. Update user request status
    public function UpdateUserRequestStatus($accountId, $statusId){
        $update = [
            'account_request_status_id'=>$statusId,
            // 'is_active'=>0
        ];
        $result = \DB::table('account_requests')
                    ->where('account_id',$accountId)
                    ->where('is_active',1)
                    ->update($update);
        return $result;
    }

    // 3. Update account type
    public function UpdateAccountType($accountId, $accountTypeId){
        $update = [
            'account_type_id' => $accountTypeId
        ];
        $result = \DB::table('accounts')
                    ->where('id',$accountId)
                    ->where('is_active',1)
                    ->update($update);
        return $result;
    }

    // 4. Non active request
    public function NonActiveAccountRequest($requestId){
        $update = [
            'is_active' => 0
        ];
        $result = \DB::table('account_requests')
                    ->where('id',$requestId)
                    ->where('is_active',1)
                    ->update($update);
        return $result;
    }

    // 5. Get request record
    public function GetRequestRecord($accountId, $requestId){
        $result = \DB::table('account_requests as ar')
                    ->select('ar.id','ars.status_th','ars.status_en','art.type_th','art.type_en')
                    ->join('account_request_types as art','art.id','=','ar.account_request_type_id')
                    ->join('account_request_statuses as ars','ars.id','=','ar.account_request_status_id')
                    ->where('ar.id',$requestId)
                    ->where('ar.account_id',$accountId)
                    ->orderBy('id','desc')
                    ->get();
        return $result;
    }

}