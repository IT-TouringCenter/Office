<?php 
namespace App\Repositories\Dashboard\Admin\Users\Add;

class AdminUserManagementAddRepository{

	public function __construct(){

    }

    //--------------- Accounts ----------------------
    // Check account repeat
    public function CheckAccountRepeat($account){
        $result = \DB::table('accounts')
                    ->where('username',$account)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Save account
    public function InsertAccount($data){
        $result = \DB::table('accounts')->insertGetId($data);
        return $result;
    }

    // Save account profile
    public function InsertAccountProfile($data){
        $result = \DB::table('account_profiles')->insertGetId($data);
        return $result;
    }

}