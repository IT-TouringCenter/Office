<?php 
namespace App\Repositories\Dashboard\Manager\Affiliate;

use Carbon\Carbon;

class ManagerAffiliateManagementRepository{

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
	public function GetAffiliateData($accountType){
		$result = \DB::table('accounts as a')
									->select('a.id','a.token','a.username','a.fullname','a.token','a.email','at.type')
									->join('account_types as at','at.id','=','a.account_type_id')
									->where('at.type',$accountType)
									->where('a.is_block_affiliate',0)
									->where('a.is_delete',0)
									->where('a.is_active',1)
									->where('at.is_active',1)
									->get();
		return $result;
	}

}