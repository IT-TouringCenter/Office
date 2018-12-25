<?php 
namespace App\Repositories\Dashboard\Admin\Users;

class AdminUserManagementRepository{

	public function __construct(){

    }

    //--------------- Accounts ----------------------
    // Get account by token & type
    public function GetAccountByTokenAndType($token,$type){
        $result = \DB::table('accounts')
                    ->where('account_type_id',$type)            
                    ->where('token',$token)
                    ->where('is_delete',0)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Get account data
    public function GetAccountData(){
        $result = \DB::table('accounts as a')
                    ->select('a.id','a.token','a.username','a.fullname','a.email','a.tel','at.type','a.is_active as isActive')
                    ->join('account_types as at','at.id','=','a.account_type_id')
                    ->where('a.is_delete',0)
                    ->where('a.is_active',1)
                    ->where('at.is_active',1)
                    // ->orderBy('a.account_type_id')
                    ->get();
        return $result;
    }

    //--------------- Transactions ------------------

}