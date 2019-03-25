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

    // Get account type
    public function GetAccountType($accountTypeId){
        $result = \DB::table('account_types')
                    ->select('type')
                    ->where('id',$accountTypeId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Non active affiliate_commissions
    public function NonActiveAffiliateCommission($accountId){
        $update = ["is_active"=>0];
        $result = \DB::table('affiliate_commissions')
                    ->where('account_id',$accountId)
                    // ->where('is_active',1)
                    ->update($update);
        return $result;
    }

    // Non active affiliate_commission_tour_rates
    public function NonActiveAffiliateCommissionTourRate($accountId){
        $update = ["is_active"=>0];
        $result = \DB::table('affiliate_commission_tour_rates')
                    ->where('account_id',$accountId)
                    // ->where('is_active',1)
                    ->update($update);
        return $result;
    }

}