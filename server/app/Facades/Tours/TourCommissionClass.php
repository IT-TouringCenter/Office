<?php
namespace App\Facades\Tours;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Tours\TourCommissionRepository as TourCommissionRepo;

use App\tour_commission_price_rate as TourCommissionPriceRate;

class TourCommissionClass{

	public function __construct(TourCommissionRepo $TourCommissionRepo){
		$this->TourCommissionRepo = $TourCommissionRepo;
	}

    // Get transaction tour
    public function GetTransactionTour($transactionTourId){
        $result = $this->TourCommissionRepo->GetTransactionTour($transactionTourId);
        return $result;
    }

    // Get account id from transactions
    public function GetTransaction($transactionId){
        $result = $this->TourCommissionRepo->GetTransaction($transactionId);
        return $result;
    }

    // Get affiliate commission
    public function GetAffiliateCommission($accountId){
        $result = $this->TourCommissionRepo->GetAffiliateCommission($accountId);
        return $result;
    }

    // Get tour commission price rate
    public function GetTourCommissionPriceRate($accountId,$tourId){
        $result = $this->TourCommissionRepo->GetTourCommissionPriceRate($accountId,$tourId);
        return $result;
    }

    // Save affiliate commission (Update)
    public function SaveAffiliateCommission($dataSave,$accountId){
        $result = $this->TourCommissionRepo->SaveAffiliateCommission($dataSave,$accountId);
        return $result;
    }

    // Save affiliate commission detail
    public function SaveAffiliateCommissionDetail($dataSave,$transactionTourId){
        $result = $this->TourCommissionRepo->SaveAffiliateCommissionDetail($dataSave,$transactionTourId);
        return $result;
    }

    // Get payment affiliate commission
    public function GetPaymentAffiliateCommission($accountId){
        $result = $this->TourCommissionRepo->GetPaymentAffiliateCommission($accountId);
        return $result;
    }

    // Save payment affiliate commission (Update)
    public function SavePaymentAffiliateCommission($dataSave,$accountId){
        $result = $this->TourCommissionRepo->SavePaymentAffiliateCommission($dataSave,$accountId);
        return $result;
    }

    // Update affiliate commission received
    public function UpdateAffiliateCommissionReceived($dataSave,$accountId){
        $result = $this->TourCommissionRepo->UpdateAffiliateCommissionReceived($dataSave,$accountId);
        return $result;
    }

    // Update payment affiliate commission
    public function UpdatePaymentAffiliateCommission($paymentData,$accountId){
        $result = $this->TourCommissionRepo->UpdatePaymentAffiliateCommission($paymentData,$accountId);
        return $result;
    }
}