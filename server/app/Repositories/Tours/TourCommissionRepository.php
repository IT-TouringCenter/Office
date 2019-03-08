<?php 
namespace App\Repositories\Tours;

use Carbon\Carbon;

use App\affiliate_commission as AffiliateCommission;
use App\affiliate_commission_detail as AffiliateCommissionDetail;
use App\payment_affiliate_commission as PaymentAffiliateCommiision;
use App\affiliate_commission_received as AffiliateCommissionReceived;

class TourCommissionRepository{    

	public function __construct(AffiliateCommission $AffiliateCommission, AffiliateCommissionDetail $AffiliateCommissionDetail, PaymentAffiliateCommiision $PaymentAffiliateCommiision, AffiliateCommissionReceived $AffiliateCommissionReceived){
		$this->AffiliateCommission = $AffiliateCommission;
		$this->AffiliateCommissionDetail = $AffiliateCommissionDetail;
		$this->PaymentAffiliateCommiision = $PaymentAffiliateCommiision;
		$this->AffiliateCommissionReceived = $AffiliateCommissionReceived;
	}

	// Get transaction tour
	public function GetTransactionTour($transactionTourId){
		$result = \DB::table('transaction_tours')
						->where('id',$transactionTourId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// Get transactions
	public function GetTransaction($transactionId){
		$result = \DB::table('transactions')
						->select('account_id','book_date')
						->where('id',$transactionId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// Get affiliate commission
	public function GetAffiliateCommission($accountId){
		$result = \DB::table('affiliate_commissions')
						->where('account_id',$accountId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// Get tour commission price rate
	public function GetTourCommissionPriceRate($accountId,$tourId){
		// $result = \DB::table('tour_commission_price_rates')
		$result = \DB::table('affiliate_commission_tour_rates')
						->select('min_pax','max_pax','price_rate')
						->where('account_id',$accountId)
						->where('tour_id',$tourId)
						->where('is_active',1)
						->get();
		return $result;
	}
	
	// Get payment affiliate commission
	public function GetPaymentAffiliateCommission($accountId){
		$result = \DB::table('payment_affiliate_commissions')
					->where('account_id',$accountId)
					->where('is_active',1)
					->get();
		return $result;
	}

	// Save tour commission (Update)
	public function SaveAffiliateCommission($dataSave,$accountId){
		$result = $this->AffiliateCommission->where('account_id',$accountId)->where('is_active',1)->update($dataSave);
		return $result;
	}

	// Save affiliate commission detail
	public function SaveAffiliateCommissionDetail($dataSave,$transactionTourId){
		$getTransactionTour = $this->AffiliateCommissionDetail->where('transaction_tour_id',$transactionTourId)->get();
		if(!empty($getTransactionTour[0])){
			return 'false transactionData';
		}else{
			$result = $this->AffiliateCommissionDetail->insertGetId($dataSave);
			return 'true transactionData';
		}
	}

	// Save payment affiliate commission (Update)
	public function SavePaymentAffiliateCommission($dataSave,$accountId){
		$result = $this->PaymentAffiliateCommiision->where('account_id',$accountId)->where('is_active',1)->update($dataSave);
		return $result;
	}

	// Update affiliate commission received
	public function UpdateAffiliateCommissionReceived($dataSave,$accountId){
		$result = $this->AffiliateCommissionReceived->where('account_id',$accountId)->where('is_active',1)->update($dataSave);
		return $result;
	}

	// Update payment affiliate commission
	public function UpdatePaymentAffiliateCommission($paymentData,$accountId){
		$result = $this->PaymentAffiliateCommiision->where('account_id',$accountId)->where('is_active',1)->update($paymentData);
		return $result;
	}

}