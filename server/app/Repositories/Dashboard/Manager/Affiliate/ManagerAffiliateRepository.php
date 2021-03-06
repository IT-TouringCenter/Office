<?php 
namespace App\Repositories\Dashboard\Manager\Affiliate;

use Carbon\Carbon;

class ManagerAffiliateRepository{

	public function __construct(){

	}

	// get account by id
	public function GetAccountByToken($token, $accountType){
		$result = \DB::table('accounts')
									->where('token',$token)
									->where('account_type_id',$accountType)
									->where('is_active',1)
									->get();
		return $result;
  }
  
  // get affiliate account
  public function GetAffiliateAccount($type){
    $result = \DB::table('accounts as a')
                  ->select('a.fullname','at.id as typeId','a.token')
                  ->join('account_types as at','at.id','=','a.account_type_id')
                  ->where('at.type',$type)
                  ->where('a.is_delete',0)
                  ->where('a.is_active',1)
                  ->get();
    return $result;
  }

}