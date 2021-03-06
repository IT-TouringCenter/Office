<?php 
namespace App\Repositories\Dashboard\Admin\Users\Active;

class AdminUserManagementActiveRepository{

	public function __construct(){

    }

    //--------------- Accounts ----------------------
    // Get account by token
    public function GetAccountByToken($token){
        $result = \DB::table('accounts')
                    ->where('token',$token)
                    ->where('is_delete',0)
                    // ->where('is_active',0)
                    ->get();
        return $result;
    }

    // Get all account
    public function GetAllAccount(){
        $result = \DB::table('accounts')
                    ->where('is_delete',0)
                    ->get();
        return $result;
    }

    // Update is_active
    public function ActiveAccountById($accountId,$data){
        $result = \DB::table('accounts')
                    ->where('id',$accountId)
                    ->where('is_active','!=',$data['is_active'])
                    ->where('is_delete',0)
                    ->update($data);
        return $result;
    }

}