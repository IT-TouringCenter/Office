<?php 
namespace App\Repositories\Reservations;

use Carbon\Carbon;

use App\transaction as Transaction;
use App\transaction_tour as TransactionTour;
use App\transaction_tour_history as TransactionTourHistory;
use App\transaction_tour_detail as TransactionTourDetail;
use App\transaction_tour_detail_history as TransactionTourDetailHistory;
use App\guest as Guest;
use App\payment as Payment;
use App\invoice_tour as InvoiceTour;

class TransactionRepository{    

	public function __construct(Transaction $Transaction, TransactionTour $TransactionTour, TransactionTourHistory $TransactionTourHistory, TransactionTourDetail $TransactionTourDetail, Guest $Guest, Payment $Payment, InvoiceTour $InvoiceTour, TransactionTourDetailHistory $TransactionTourDetailHistory){
		$this->Transaction = $Transaction;
		$this->TransactionTour = $TransactionTour;		
		$this->TransactionTourHistory = $TransactionTourHistory;
		$this->TransactionTourDetail = $TransactionTourDetail;
		$this->TransactionTourDetailHistory = $TransactionTourDetailHistory;
		$this->Guest = $Guest;
		$this->Payment = $Payment;
		$this->InvoiceTour = $InvoiceTour;
	}

	// Save transaction
	public function SaveTransactionBooking($bookingData){
		// $dateTimeNow = date('Y-m-d H:i:s');
		$dateTimeNow = Carbon::now('Asia/Bangkok');
		$dateNow = $dateTimeNow->format('Y-m-d');
		$timeNow = $dateTimeNow->format('H:i:s');

		$bookingInfo = array_get($bookingData,'bookingInfo');
		$bookBy = array_get($bookingData,'bookBy');
		$noteBy = array_get($bookingData,'noteBy');
		$paymentInfo = array_get($bookingData,'paymentInfo');
		$commission = array_get($bookingData,'commission');
		$summary = array_get($bookingData,'summary');
		$insurance = array_get($bookingData,'insurance');

		$transaction = [
			'account_id'=>'',
			'transaction_status_id'=>1,
			'customer_code_id'=>array_get($bookBy,'code'),
			'payment_mode'=>array_get($paymentInfo,'tourPrice'),
			'payment_collect'=>array_get($paymentInfo,'paymentCollect'),
			'book_by_name'=>array_get($bookBy,'name'),
			'book_by_position'=>array_get($bookBy,'position'),
			'book_by_hotel'=>array_get($bookBy,'hotel'),
			'book_by_tel'=>array_get($bookBy,'tel'),
			'note_by'=>array_get($noteBy,'name'),
			'book_date'=>$dateNow,
			'book_time'=>$timeNow,
			'commission'=>array_get($commission,'amount'),
			'discount'=>array_get($summary,'discountPrice'),
			'service_charge'=>array_get($summary,'serviceCharge'),
			'amount'=>array_get($summary,'amount'),
			'insurance_note'=>array_get($insurance,'insuranceReason')==null?'':array_get($insurance,'insuranceReason'),
			'issued_by'=>array_get($bookingData,'issuedBy'),
			'is_insurance'=>array_get($insurance,'isInsurance')==true?1:0,
			'is_service_charge'=>array_get($bookingInfo,'isServiceCharge')==true?1:0,
			'is_advance'=>0,
			'is_commission'=>array_get($commission,'isCommission')==true?1:0,
			'created_by'=>array_get($noteBy,'name'),
			'created_at'=>$dateTimeNow
		];
		return $this->Transaction->insertGetId($transaction);
	}

	// Save transaction tour
	public function SaveTransactionTourBooking($transactionId,$bookingData){
		// $dateTimeNow = date('Y-m-d H:i:s');
		$dateTimeNow = Carbon::now('Asia/Bangkok');
		$dateNow = $dateTimeNow->format('Y-m-d');
		// $timeNow = $dateTimeNow->format('H:i:s');

		$bookingInfo = array_get($bookingData,'bookingInfo');
		$bookBy = array_get($bookingData,'bookBy');
		$noteBy = array_get($bookingData,'noteBy');
		$summary = array_get($bookingData,'summary');
		$hotel = array_get($bookingData,'hotelInfo');

		$tour = [
			'transaction_id'=>$transactionId,
			'tour_id'=>array_get($bookingInfo,'tourId'),
			'tour_code'=>array_get($bookingInfo,'tourCode'),
			'tour_title'=>array_get($bookingInfo,'tourName'),
			'tour_privacy'=>array_get($bookingInfo,'tourPrivacy'),
			'tour_travel_time'=>array_get($bookingInfo,'travelTime'),
			'tour_travel_date'=>array_get($bookingInfo,'travelDate'),
			'rate_two_pax'=>array_get($bookingInfo,'rateTwoPax'),
			'pax'=>array_get($bookingInfo,'pax'),
			'adult_pax'=>array_get($bookingInfo,'adultPax'),
			'child_pax'=>array_get($bookingInfo,'childPax'),
			'infant_pax'=>array_get($bookingInfo,'infantPax'),
			'single_riding_pax'=>array_get($summary,'singleRidingPax'),
			'single_riding'=>array_get($summary,'singleRiding'),
			'deposit_price'=>array_get($summary,'deposit')==null?0:array_get($summary,'deposit'),
			'discount_rate'=>array_get($summary,'discount'),
			'discount'=>array_get($summary,'discountPrice'),
			'adult_price'=>array_get($summary,'adultPrice'),
			'child_price'=>array_get($summary,'childPrice'),
			'total_adult_price'=>array_get($summary,'totalAdultPrice'),
			'total_child_price'=>array_get($summary,'totalChildPrice'),
			'total_price'=>array_get($summary,'totalPrice'),
			'amount'=>array_get($summary,'amount'),
			'hotel'=>array_get($hotel,'name'),
			'hotel_room'=>array_get($hotel,'room'),
			'ota_code'=>array_get($bookBy,'otaCode'),
			'special_charge_price'=>array_get($bookingData,'specialChargePrice'),
			'special_request'=>array_get($bookingData,'specialRequest')==null?'':array_get($bookingData,'specialRequest'),
			'special_request_price'=>array_get($bookingData,'specialRequestPrice'),
			'is_special_request_operator'=>array_get($bookingData,'specialRequestOperator'),
			'is_special_tour'=>array_get($bookingData,'isSpecialTour'),
			'created_by'=>array_get($noteBy,'name'),
			'created_at'=>$dateNow
		];
		$saveTourGetId = $this->TransactionTour->insertGetId($tour);

		// Save transaction tour history
		$tourHistory = [
			'transaction_tour_id'=>$saveTourGetId,
			'tour_id'=>array_get($tour,'tour_id'),
			'tour_code'=>array_get($tour,'tour_code'),
			'tour_title'=>array_get($tour,'tour_title'),
			'tour_privacy'=>array_get($tour,'tour_privacy'),
			'tour_travel_time'=>array_get($tour,'tour_travel_time'),
			'tour_travel_date'=>array_get($tour,'tour_travel_date'),
			'rate_two_pax'=>array_get($tour,'rate_two_pax'),
			'pax'=>array_get($tour,'pax'),
			'adult_pax'=>array_get($tour,'adult_pax'),
			'child_pax'=>array_get($tour,'child_pax'),
			'infant_pax'=>array_get($tour,'infant_pax'),
			'single_riding_pax'=>array_get($tour,'single_riding_pax'),
			'single_riding'=>array_get($tour,'single_riding'),
			'deposit_price'=>array_get($tour,'deposit_price')==null?0:array_get($tour,'deposit_price'),
			'discount_rate'=>array_get($tour,'discount_rate'),
			'discount'=>array_get($tour,'discount'),
			'adult_price'=>array_get($tour,'adult_price'),
			'child_price'=>array_get($tour,'child_price'),
			'total_adult_price'=>array_get($tour,'total_adult_price'),
			'total_child_price'=>array_get($tour,'total_child_price'),
			'total_price'=>array_get($tour,'total_price'),
			'amount'=>array_get($tour,'amount'),
			'hotel'=>array_get($tour,'hotel'),
			'hotel_room'=>array_get($tour,'hotel_room'),
			'ota_code'=>array_get($tour,'ota_code'),
			'special_charge_price'=>array_get($tour,'special_charge_price'),
			'special_request'=>array_get($tour,'special_request')==null?'':array_get($tour,'special_request'),
			'special_request_price'=>array_get($tour,'special_request_price'),
			'is_special_request_operator'=>array_get($tour,'is_special_request_operator'),
			'is_special_tour'=>array_get($tour,'is_special_tour'),
			'created_by'=>array_get($tour,'created_by'),
			'created_at'=>array_get($tour,'created_at')
		];
		$saveTourHistoryGetId = $this->TransactionTourHistory->insertGetId($tourHistory);

		$returnTour = new Transaction;
		$returnTour->transactionTourId = $saveTourGetId;
		$returnTour->transactionTourHistoryId = $saveTourHistoryGetId;

		return $returnTour;
	}

	// Save guest
	public function SaveGuestData($guestData,$count,$noteBy){
		// $dateTimeNow = date('Y-m-d H:i:s');
		$dateTimeNow = Carbon::now('Asia/Bangkok');
		$dateNow = $dateTimeNow->format('Y-m-d');
		// $timeNow = $dateTimeNow->format('H:i:s');
		$guest = [
			'fullname'=>array_get($guestData,'name'),
			'is_primary'=>$count==1?1:0,
			'is_adult'=>array_get($guestData,'isAges')==1?1:0,
			'is_infant'=>array_get($guestData,'isAges')==3?1:0,
			'created_by'=>array_get($noteBy,'name'),
			'created_at'=>$dateTimeNow
		];
		return $this->Guest->insertGetId($guest);
	}

	// Save transaction tour detail
	public function SaveTransactionTourDetail($transactionTourId,$guestId,$guestData,$ages,$noteBy){
		// $dateTimeNow = date('Y-m-d H:i:s');
		$dateTimeNow = Carbon::now('Asia/Bangkok');
		$dateNow = $dateTimeNow->format('Y-m-d');
		// $timeNow = $dateTimeNow->format('H:i:s');
		$tourDetail = [
			'transaction_tour_id'=>$transactionTourId,
			'guest_id'=>$guestId,
			'fullname'=>array_get($guestData,'name'),
			'ages'=>$ages,
			'created_by'=>array_get($noteBy,'name'),
			'created_at'=>$dateTimeNow
		];
		$TourDetailGetId = $this->TransactionTourDetail->insertGetId($tourDetail);

		$tourDetailHistory = [
			'transaction_tour_detail_id'=>$TourDetailGetId,
			'guest_id'=>array_get($tourDetail,'guest_id'),
			'fullname'=>array_get($tourDetail,'fullname'),
			'ages'=>array_get($tourDetail,'ages'),
			'created_by'=>array_get($tourDetail,'created_by'),
			'created_at'=>array_get($tourDetail,'created_at')
		];
		$TourDetailHistoryGetId = $this->TransactionTourDetailHistory->insertGetId($tourDetailHistory);

		$returnTourDetail = new Transaction;
		$returnTourDetail->transactionTourDetailId = $TourDetailGetId;
		$returnTourDetail->transactionTourDetailHistoryId = $TourDetailHistoryGetId;

		return $returnTourDetail;
	}

	// Save payment
	public function SaveBookingPayment($transactionId,$summary,$noteBy){
		// $dateTimeNow = date('Y-m-d H:i:s');
		$dateTimeNow = Carbon::now('Asia/Bangkok');
		$payment = [
			'transaction_id'=>$transactionId,
			'payment_status_id'=>1,
			'payment_channel_id'=>null,
			'payment_mode_id'=>null,
			'amount'=>array_get($summary,'amount'),
			'expired_date'=>null,
			'payment_date'=>null,
			'is_expired'=>0,
			'created_by'=>array_get($noteBy,'name'),
			'created_at'=>$dateTimeNow
		];
		return $this->Payment->insertGetId($payment);
	}

	// Save invoice
	public function SaveInvoiceTour($transactionId,$transactionTourId,$invoiceNumberData,$noteBy,$invoiceRef,$isRevised){
		// $dateTimeNow = date('Y-m-d H:i:s');
		$dateTimeNow = Carbon::now('Asia/Bangkok');
		$bookingNumber = [
			'transaction_id'=>$transactionId,
			'transaction_tour_id'=>$transactionTourId,
			'invoice_referent_id'=>array_get($invoiceRef,'id'),
			'booking_number'=>array_get($invoiceNumberData,'bookingNumber'),
			'booking_number_ref'=>array_get($invoiceRef,'number'),
			'invoice_number'=>array_get($invoiceNumberData,'invoiceNumber'),
			'issued_by'=>array_get($noteBy,'name'),
			'is_revised'=>$isRevised,
			'created_by'=>array_get($noteBy,'name'),
			'created_at'=>$dateTimeNow
		];
		return $this->InvoiceTour->insertGetId($bookingNumber);
	}

	//----------------------------------------------------------------------------------------------------
	// Get transaction by ID
	public function GetTransactionById($transactionId){
		$result = \DB::table('transactions')
					->where('id',$transactionId)
					->where('is_active',1)
					->get();
		return $result;
	}

	// Get transaction tour by transaction ID
	public function GetTransactionTourById($transactionId){
		$result = \DB::table('transaction_tours')
					->where('transaction_id',$transactionId)
					->where('is_active',1)
					->get();
		return $result;
	}

	// Get transaction tour detail by transaction tour ID
	public function GetTransactionTourDetail($transactionTourId){
		$result = \DB::table('transaction_tour_details')
					->where('transaction_tour_id',$transactionTourId)
					->where('is_active',1)
					->get();
		return $result;
	}

	//----------------------------------------------------------------------------------------------------
	// Get transaction
	public function GetTransactionAll(){
		$result = \DB::table('transactions')
					->where('is_active',1)
					->orderBy('id','desc')
					->get();
		return $result;
	}

	// Get tour travel time by tour id
	public function GetTourTravelTimeByTourId($tourId, $tourTravelTime){
		$result = \DB::table('tour_travel_times')
					->where('tour_id',$tourId)
					->where('meridiem',$tourTravelTime)
					->where('is_active',1)
					->get();
		return $result;
	}

}