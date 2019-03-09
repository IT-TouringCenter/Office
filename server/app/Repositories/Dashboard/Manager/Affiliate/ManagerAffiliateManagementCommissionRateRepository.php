<?php 
namespace App\Repositories\Dashboard\Manager\Affiliate;

use Carbon\Carbon;

class ManagerAffiliateManagementCommissionRateRepository{

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

	// get affiliate by token
	public function GetAffiliateByToken($token){
		$result = \DB::table('accounts')
									->where('token',$token)
									->where('is_active',1)
									->get();
		return $result;
	}

	// get commission rate
	public function GetCommissionRate($accountId){
		$result = \DB::table('affiliate_commission_tour_rates as actr')
									->select('actr.price_rate','t.id','t.code','t.title')
									->join('tours as t','t.id','=','actr.tour_id')
									->where('actr.account_id',$accountId)
									->where('actr.is_active',1)
									->get();
		return $result;
	}

}