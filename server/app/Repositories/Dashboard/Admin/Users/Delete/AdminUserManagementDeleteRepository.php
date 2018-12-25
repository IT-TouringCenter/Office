<?php 
namespace App\Repositories\Dashboard\Admin\Users\Delete;

class AdminUserManagementDeleteRepository{

	public function __construct(){

    }

    //--------------- Accounts ----------------------
    // Get account by token
    public function GetAccountByToken($token){
        $result = \DB::table('accounts')
                    ->where('token',$token)
                    ->where('is_delete',0)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Update account by id | update is_delete
    public function DeleteAccountById($accountId,$data){
        $result = \DB::table('accounts')->where('id',$accountId)->update($data);
        return $result;
    }

}