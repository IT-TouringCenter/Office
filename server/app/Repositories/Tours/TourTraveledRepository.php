<?php 
namespace App\Repositories\Tours;

use Carbon\Carbon;

use App\transaction_tour as TransactionTour;

class TourTraveledRepository{    

	public function __construct(TransactionTour $TransactionTour){
        $this->TransactionTour = $TransactionTour;
    }
    
    // Get value to check before updating
    public function GetTransactionTour($data){
        $result = \DB::table('transaction_tours')
                        ->select('id')
                        ->where('tour_id',$data->tourId)
                        ->where('tour_privacy',$data->tourPrivacy)
                        ->where('tour_travel_time',$data->tourTravelTime)
                        ->where('tour_travel_date',$data->tourTravelDate)
                        ->where('is_travel','!=',1)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // Update tour traveled :: model transaction tour
    public function UpdateTourTraveled($transactionTourId){
        $update = ['is_travel'=>1];
        $result = $this->TransactionTour
                        ->where('id',$transactionTourId)
                        ->where('is_travel','!=',1)
                        ->where('is_active',1)
                        ->update($update);
        return $result;
    }

    // Update tour travel :: model affiliate commission tour detail
    public function UpdateAffiliateTourTraveled($transactionTourId){
        $update = ['is_travel'=>1];
        $result = \DB::table('affiliate_commission_details')
                        ->where('transaction_tour_id',$transactionTourId)
                        ->where('is_travel','!=',1)
                        ->where('is_active',1)
                        ->update($update);
        return $result;
    }

    // Get tour affiliate commission detail
    public function GetTourAffiliateCommissionDetail($transactionTourId){
        $result = \DB::table('affiliate_commission_details')
                        ->where('transaction_tour_id',$transactionTourId)
                        // ->where('is_travel',1)
                        ->where('is_active',1)
                        ->get();
        return $result;
    }

    // Get tour affiliate commission received
    public function GetTourAffiliateCommissionReceived($accountId){
        $result = \DB::table('affiliate_commission_receiveds')
                        ->where('account_id',$accountId)
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

}