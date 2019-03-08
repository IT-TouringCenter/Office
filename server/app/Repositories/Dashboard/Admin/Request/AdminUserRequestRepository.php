<?php 
namespace App\Repositories\Dashboard\Admin\Request;

class AdminUserRequestRepository{

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

    // 2. Get request
    public function GetUserRequest(){
        $result = \DB::table('account_requests as ar')
                    ->select('ar.account_id','a.token','ar.id','art.id as type_id','ars.id as status_id','a.username','a.fullname','art.type_th','art.type_en','ars.status_th','ars.status_en','ar.created_at')
                    ->join('accounts as a','a.id','=','ar.account_id')
                    ->join('account_request_types as art','art.id','=','ar.account_request_type_id')
                    ->join('account_request_statuses as ars','ars.id','=','ar.account_request_status_id')
                    ->where('ar.is_active',1)
                    ->get();
        return $result;
    }

    // 3. 
    public function GetUserRequestProfile($accountId){
        $result = \DB::table('account_requests as ar')
                    ->get();
        return $result;
    }

}