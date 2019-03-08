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
    public function CheckAccountType($accountId, $accountTypeId){
        $result = \DB::table('accounts as a')
                    ->select('at.type')
                    ->join('account_types as at','at.id','=','a.account_type_id')
                    ->where('a.id',$accountId)
                    ->where('a.is_active',1)
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
}