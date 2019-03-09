<?php 
namespace App\Repositories\Dashboard\Manager\Affiliate;

use Carbon\Carbon;

class ManagerAffiliateUpdateCommissionRateRepository{

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
	
	// get affiliate data
	public function GetAffiliateByToken($token){
		$result = \DB::table('accounts')
									->where('token',$token)
									->where('is_active',1)
									->get();
		return $result;
	}

	// update commission rate
	public function UpdateCommissionRate($accountId, $tourId, $data){
		$result = \DB::table('affiliate_commission_tour_rates')
									->where('account_id',$accountId)
									->where('tour_id',$tourId)
									->where('is_active',1)
									->update($data);
		return $result;
	}
}