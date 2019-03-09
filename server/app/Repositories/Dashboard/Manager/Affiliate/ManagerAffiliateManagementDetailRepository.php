<?php 
namespace App\Repositories\Dashboard\Manager\Affiliate;

use Carbon\Carbon;

class ManagerAffiliateManagementDetailRepository{

	public function __construct(){

	}

	// get account by token
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

	// get affiliate data
	public function GetAffiliateData($accountId){
		$result = \DB::table('accounts as a')
									->select('a.id','a.token','a.fullname','a.email','a.tel','at.type','ap.birth','ap.id_number','ap.address','ap.nationality','ap.picture','ap.copy_id_card','ap.url')
									->join('account_types as at','at.id','=','a.account_type_id')
									->join('account_profiles as ap','ap.account_id','=','a.id')
									->where('a.id',$accountId)
									->where('a.is_active',1)
									->get();
		return $result;
	}

	// get bank data
	public function GetAffiliateBankData($accountId){
		$result = \DB::table('account_book_banks as abb')
									// ->select('abb.account_name','abb.account_no','abb.bank','abb.branch','abb.copy_book')
									// ->where('banks as b','b.id','=','abb.bank_id')
									->where('account_id',$accountId)
									->where('is_active',1)
									->get();
		return $result;
	}

}