<?php 
namespace App\Repositories\Reservations\Tours;

use App\tour as Tour;
use App\tour_travel_time as TourTravelTime;
use App\tour_privacy as TourPrivacy;
use App\configuration_tour_price as ConfigTourPrice;
use App\tour_pax as TourPax;
use App\payment_mode as PaymentMode;

class TourRepository{

	public function __construct(Tour $Tour, TourTravelTime $TourTravelTime, TourPrivacy $TourPrivacy, ConfigTourPrice $ConfigTourPrice, TourPax $TourPax, PaymentMode $PaymentMode){
		$this->Tour = $Tour;
		$this->TourTravelTime = $TourTravelTime;
		$this->TourPrivacy = $TourPrivacy;
		$this->ConfigTourPrice = $ConfigTourPrice;
		$this->TourPax = $TourPax;
		$this->PaymentMode = $PaymentMode;
	}

	// Reservation System
	// Get data booking to booking form (Insert)
	public function GetTourDataToBooking(){
		// $result = \DB::table('transaction_transfer_airports as tta')
        //             ->select('tta.passenger_id as passengerId')
        //             ->join('payment_transactions as pt', 'pt.transaction_id','=','tta.transaction_id')
        //             ->where('tta.transaction_id',$transactionId)
        //             ->where('pt.payment_transaction_status_id','=','2')
        //             ->groupBy('passenger_id')
		//             ->get();
		$result = \DB::table('tours as t')
					->select('t.id','t.code','t.title')
					->get();
		// $result = $this->Tour
		// 				->select('id','code','title')
		// 				->where('is_active',1)
		// 				->get();
        return $result;
	}

	// Get tour travel time by tour ID
	public function GetTourTravelTimeByTourId($tourId){
		$result = $this->TourTravelTime
						->where('tour_id',$tourId)
						->select('id','meridiem','travel_time_start','travel_time_end','pickup_time')
						->where('is_active',1)
						->get();
		return $result;
	}

	// Get tour privacy
	public function GetTourPrivacy(){
		$result = $this->TourPrivacy
						->select('id','privacy')
						->where('is_active',1)
						->get();
		return $result;
	}

	// Get tour pax by tour privacy ID
	public function GetPaxbyTourPrivacyId($tourId, $privacyId){
		$result = $this->ConfigTourPrice
						->select('tour_pax_id')
						->where('tour_id',$tourId)
						->where('tour_privacy_id',$privacyId)
						->groupBy('tour_pax_id')
						->where('is_active',1)
						->get();
		return $result;
	}

	public function GetPaxDetail($paxId){
		$result = $this->TourPax
						->select('id','min_pax','max_pax')
						->where('id',$paxId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// Get payment mode detail
	public function GetPaymentId($tourId,$privacyId,$paxId){
		$result = $this->ConfigTourPrice
						->select('payment_mode_id')
						->where('tour_id',$tourId)
						->where('tour_privacy_id',$privacyId)
						->where('tour_pax_id',$paxId)
						->where('is_active',1)
						->get();
		return $result;
	}

	public function GetPaymentMode($paymentModeId){
		$result = $this->PaymentMode
						->select('mode')
						->where('id',$paymentModeId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// Get tour price
	public function GetTourPrice($tourId,$tourPrivacyId,$paxId,$tourPaymentModeId){
		$result = $this->ConfigTourPrice
						->select(
							'adult_price as adultPrice',
							'child_price as childPrice',
							'single_riding as singleRiding',
							'commission_adult as commissionAdult',
							'commission_child as commissionChild',
							'period_start as periodStart',
							'period_end as periodEnd'
						)
						->where('tour_id',$tourId)
						->where('tour_privacy_id',$tourPrivacyId)
						->where('tour_pax_id',$paxId)
						->where('payment_mode_id',$tourPaymentModeId)
						->where('is_active',1)
						->get();
		return $result;
	}

	// Get tour travel time by tour ID
	// public function GetTourTravelTimeByTourId($tourId){
	// 	$result = \DB::table('tour_travel_times')
	// 				->where('tour_id',$tourId)
	// 				->where('is_active',1)
	// 				->get();
	// 	return $result;
	// }

}