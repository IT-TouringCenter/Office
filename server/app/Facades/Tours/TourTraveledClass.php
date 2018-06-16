<?php
namespace App\Facades\Tours;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Tours\TourTraveledRepository as TourTraveledRepo;

use App\tour as Tour;

class TourTraveledClass{

	public function __construct(TourTraveledRepo $TourTraveledRepo){
		$this->TourTraveledRepo = $TourTraveledRepo;
	}

	/* ------------------------------------
	 	Logic 
			1. Update tour traveled in model transaction_tours
				1.1 
			2. Calculate affiliate tour commission
				2.1 update model affiliate_commission_receiveds
				2.2 update model payment_affiliate_commission
	------------------------------------ */

	// 1. Update tour traveled
	public function UpdateTourTraveled($data){
		$checkUpdate = array_get($data,'isUpdate');
		if($checkUpdate==false){
			return 'Can not update travel.';
		}
		$setTourDate = \DateFormatFacade::SetFormatFullDate(array_get($data,'travelDate'));

		$tour = new Tour;
		$tour->tourId = array_get($data,'tourId');
		$tour->tourPrivacy = array_get($data,'privacy');
		$tour->tourTravelTime = array_get($data,'travelTime');
		$tour->tourTravelDate = $setTourDate;

		// 1.1 Get value to check before updating
		$getTransactionTour = $this->TourTraveledRepo->GetTransactionTour($tour);

		$calculateArr = [];
		if($getTransactionTour){
			foreach($getTransactionTour as $value){
				$updateTourTravel = $this->TourTraveledRepo->UpdateTourTraveled($value->id);
				// 2. Calculate affiliate tour commission
				if($updateTourTravel){
					$calculate = $this->CalculateAffiliateTourCommission($value->id);
					array_push($calculateArr,$calculate);
				}
			}
			return $calculateArr;
			// return "true";
		}else{
			return "false 1.1";
		}

	}

	// 2. Calculate affiliate tour commission
	public function CalculateAffiliateTourCommission($transactionTourId){
		$result = "false 2.0";
		$getComDetail = $this->TourTraveledRepo->GetTourAffiliateCommissionDetail($transactionTourId);
		$getComDetailEmpty = [];

		if(empty($getComDetail)){
			return $getComDetailEmpty;
		}

		$accountId = $getComDetail[0]->account_id;

		$updateTourAffiliateCommissionDetail = $this->TourTraveledRepo->UpdateAffiliateTourTraveled($transactionTourId);
		if($updateTourAffiliateCommissionDetail){
			if($accountId>0){
			// 2.1 update model affiliate_commission_receiveds
				$getComReceived = $this->TourTraveledRepo->GetTourAffiliateCommissionReceived($accountId);

				// Set data
				$pax = $getComReceived[0]->pax + $getComDetail[0]->pax;
				$adultPax = $getComReceived[0]->adult_pax + $getComDetail[0]->adult_pax;
				$childPax = $getComReceived[0]->child_pax + $getComDetail[0]->child_pax;
				$infantPax = $getComReceived[0]->infant_pax + $getComDetail[0]->infant_pax;
				$adultPrice = $getComReceived[0]->adult_price + $getComDetail[0]->adult_price;
				$childPrice = $getComReceived[0]->child_price + $getComDetail[0]->child_price;
				$comAdultPrice = $getComReceived[0]->commission_adult + $getComDetail[0]->commission_adult;
				$comChildPrice = $getComReceived[0]->commission_child + $getComDetail[0]->commission_child;
				$comTotalPrice = $getComReceived[0]->commission_total + $getComDetail[0]->commission_total;
				$comBonusPrice = $getComReceived[0]->commission_bonus + $getComDetail[0]->commission_bonus;
				$comAmountPrice = $getComReceived[0]->commission_amount + $getComDetail[0]->commission_amount;

				$dataSave = [
					'pax'=>$pax,
					'adult_pax'=>$adultPax,
					'child_pax'=>$childPax,
					'infant_pax'=>$infantPax,
					'adult_price'=>$adultPrice,
					'child_price'=>$childPrice,
					'commission_adult'=>$comAdultPrice,
					'commission_child'=>$comChildPrice,
					'commission_total'=>$comTotalPrice,
					'commission_bonus'=>$comBonusPrice,
					'commission_amount'=>$comAmountPrice
				];

				// save data
				$updateAffiliateCommissionReceived = \TourCommissionFacade::UpdateAffiliateCommissionReceived($dataSave,$accountId);
				if($updateAffiliateCommissionReceived){
					$result = "true 2.1";
				}

			// 2.2 update model payment_affiliate_commission
				$GetPaymentCommission = $this->TourTraveledRepo->GetPaymentAffiliateCommission($accountId);
				// Set data
				$paymentPax = $GetPaymentCommission[0]->pax + $getComDetail[0]->pax;
				$paymentAdultPax = $GetPaymentCommission[0]->adult_pax + $getComDetail[0]->adult_pax;
				$paymentChildPax = $GetPaymentCommission[0]->child_pax + $getComDetail[0]->child_pax;
				$paymentInfantPax = $GetPaymentCommission[0]->infant_pax + $getComDetail[0]->infant_pax;
				$paymentAdultPrice = $GetPaymentCommission[0]->adult_price + $getComDetail[0]->adult_price;
				$paymentChildPrice = $GetPaymentCommission[0]->child_price + $getComDetail[0]->child_price;
				$paymentComAdultPrice = $GetPaymentCommission[0]->commission_adult + $getComDetail[0]->commission_adult;
				$paymentComChildPrice = $GetPaymentCommission[0]->commission_child + $getComDetail[0]->commission_child;
				$paymentComTotalPrice = $GetPaymentCommission[0]->commission_total + $getComDetail[0]->commission_total;
				$paymentComBonusPrice = $GetPaymentCommission[0]->commission_bonus + $getComDetail[0]->commission_bonus;
				$paymentComAmountPrice = $GetPaymentCommission[0]->commission_amount + $getComDetail[0]->commission_amount;

				$paymentSave = [
					'pax'=>$paymentPax,
					'adult_pax'=>$paymentAdultPax,
					'child_pax'=>$paymentChildPax,
					'infant_pax'=>$paymentInfantPax,
					'adult_price'=>$paymentAdultPrice,
					'child_price'=>$paymentChildPrice,
					'commission_adult'=>$paymentComAdultPrice,
					'commission_child'=>$paymentComChildPrice,
					'commission_total'=>$paymentComTotalPrice,
					'commission_bonus'=>$paymentComBonusPrice,
					'commission_amount'=>$paymentComAmountPrice
				];

				// save data
				$updatePaymentAffiliateCommission = \TourCommissionFacade::UpdatePaymentAffiliateCommission($paymentSave,$accountId);
				if($updatePaymentAffiliateCommission){
					$result = "true";
				}
			} // end check account != 0
		}
		return $result;
	}

	// Update tour travel (Per person)
	/*
		1. Update is_travel in transaction_tours
		2. Calculate affiliate tour commission

	*/
	public function UpdateTourTraveledPerBook($data){
		$transactionTourId = array_get($data,'transactionTourId');

		$updateTourTraveled = $this->TourTraveledRepo->UpdateTourTraveled($transactionTourId);

		if($updateTourTraveled){
			$saveCommission = $this->CalculateAffiliateTourCommission($transactionTourId);
			return 'true';
		}else{
			return 'false';
		}
	}
}