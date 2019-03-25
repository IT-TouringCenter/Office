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

    //---------------- Affilaite ------------------
    // Check account type
    public function CheckAccountType($accountTypeId){
        $result = \DB::table('account_types')
                    ->select('type')
                    ->where('id',$accountTypeId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Check account type by account id
    public function CheckAccountTypeByAccountId($accountId, $accountTypeId){
        $result = \DB::table('accounts as a')
                    ->select('at.type')
                    ->join('account_types as at','at.id','=','a.account_type_id')
                    ->where('a.id',$accountId)
                    ->where('a.is_active',1)
                    ->where('at.id',$accountTypeId)
                    ->where('at.is_active',1)
                    ->get();
        return $result;
    }

    // Get tour
    public function GetTour(){
        $result = \DB::table('tours')
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Insert affilaite commission
    public function InsertAffiliateCommission($data){
        $result = \DB::table('affiliate_commissions')->insertGetId($data);
        return $result;
    }

    // Insert affiliate commission tour rate
    public function InsertAffiliateCommissionTourRate($data){
        $result = \DB::table('affiliate_commission_tour_rates')->insertGetId($data);
        return $result;
    }

    // Check affiliate_commissions
    public function CheckAffiliateCommission($accountId){
        $result = \DB::table('affiliate_commissions')->where('account_id',$accountId)->get();
        return $result;
    }

    // Active affiliate_commissions
    public function ActiveAffiliateCommission($accountId){
        $update = ["is_active"=>1];
        $result = \DB::table('affiliate_commissions')->where('account_id',$accountId)->update($update);
        return $result;
    }

    // Non active affiliate_commissions
    public function NonActiveAffiliateCommission($accountId){
        $update = ["is_active"=>0];
        $result = \DB::table('affiliate_commissions')->where('account_id',$accountId)->update($update);
        return $result;
    }

    // Non active affiliate_commission_rates
    public function NonActiveAffiliateCommissionRate($accountId){
        $update = ["is_active"=>0];
        $result = \DB::table('affiliate_commission_tour_rates')->where('account_id',$accountId)->where('is_active',1)->update($update);
        return $result;
    }
}