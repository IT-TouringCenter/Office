<?php 
namespace App\Repositories\Dashboard\Admin\Users\Edit;

class AdminUserManagementEditRepository{

	public function __construct(){

    }

    //--------------- Accounts ----------------------
    // Get user by token
    public function GetUserByToken($token){
        $result = \DB::table('accounts as a')
                    ->select(
                        'a.id as id',
                        'a.username',
                        'a.account_type_id as accountTypeId',
                        'at.type',
                        'a.fullname',
                        'a.email'
                    )
                    ->join('account_types as at','at.id','=','a.account_type_id')
                    ->where('a.token',$token)
                    ->where('a.is_delete',0)
                    ->where('a.is_active',1)
                    ->get();
        return $result;
    }

    // Get account by token
    public function GetAccountByToken($token){
        $result = \DB::table('accounts')
                    ->where('token',$token)
                    ->where('is_delete',0)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    //---------- Update -------------------------------------------//
    // Update account by id
    public function UpdateAccountById($accountId,$data){
        $result = \DB::table('accounts')->where('id',$accountId)->update($data);
        return $result;
    }

    // Update account profile by account_id
    public function UpdateAccountProfileByAccountId($accountId,$data){
        $result = \DB::table('account_profiles')->where('account_id',$accountId)->update($data);
        return $result;
    }

}