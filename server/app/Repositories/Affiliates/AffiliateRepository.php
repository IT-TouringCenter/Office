<?php 
namespace App\Repositories\Affiliates;

use Carbon\Carbon;

use App\account as Account;

class AffiliateRepository{    

	public function __construct(Account $Account){
        $this->Account = $Account;
	}

	// Get transaction tour by id
	public function GetTransactionTourById($transTourId){
		$result = \DB::table('transaction_tours as tt')
					->select(
						't.account_id',
						't.book_date',
						'tt.tour_id',
						'tt.travel_date',
						'tt.pax',
						'tt.adult_pax',
						'tt.child_pax',
						'tt.infant_pax',
						'tt.total_adult_price as total_adult_price',
						'tt.total_child_price as total_child_price',
						'tt.commission_adult',
						'tt.commission_child'
					)
					->join('transactions as t','t.id','=','tt.transaction_id')
					->where('tt.id',$transTourId)
					->get();
		return $result;
	}

	// Update commission by tour in transaction_tour_id
	public function UpdateAffiliateCommissionByTour($transactionTourId,$commission){
		$result = \DB::table('transaction_tours')
					->where('id',$transactionTourId)
					->where('is_travel',1)
					->where('is_cancel',0)
					->where('is_active',1)
					->update($commission);
		return $result;
	}

	// Get all commission by account_id
	public function GetAffiliateCommission($accountId){
		$result = \DB::table('affiliate_commissions')
					->where('account_id',$accountId)
					->get();
		return $result;
	}

	// Save affiliate commission detail
	public function SaveAffiliateCommissionDetail($data){
		$result = \DB::table('affiliate_commission_details')->insertGetId($data);
		return $result;
	}

	// Update commission
	public function UpdateAffiliateCommission($accountId,$data){
		$result = \DB::table('affiliate_commissions')
									->where('account_id',$accountId)
									->update($data);
		return $result;
	}

	// Get affiliate commission tour rate
	public function GetAffiliateCommissionTourRate($accountId,$tourId){
		$result = \DB::table('affiliate_commission_tour_rates')
									->select('min_pax','max_pax','price_rate')
									->where('account_id',$accountId)
									->where('tour_id',$tourId)
									->where('is_active',1)
									->get();
		return $result;
	}
}