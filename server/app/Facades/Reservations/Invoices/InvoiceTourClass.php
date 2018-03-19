<?php
namespace App\Facades\Reservations\Invoices;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Reservations\Invoices\InvoiceTourRepository as InvoiceTourOfflineRepo;
use App\Repositories\Reservations\TransactionRepository as TransactionRepo;
use App\Repositories\Reservations\Tours\TourRepository as TourRepo;
use App\Repositories\Reservations\Accounts\AccountCodeRepository as AccountCodeRepo;

use App\invoice_tour_offline as InvoiceTourOffline;

class InvoiceTourClass{

	public function __construct(InvoiceTourOfflineRepo $InvoiceTourOfflineRepo, TransactionRepo $TransactionRepo, TourRepo $TourRepo, AccountCodeRepo $AccountCodeRepo){
		$this->InvoiceTourOfflineRepo = $InvoiceTourOfflineRepo;
		$this->TransactionRepo = $TransactionRepo;
		$this->TourRepo = $TourRepo;
		$this->AccountCodeRepo = $AccountCodeRepo;
	}

	// Get invoice number
	public function GetLastInvoiceNumber(){
        $result = $this->InvoiceTourOfflineRepo->GetLastInvoiceNumber();
        return $result;
	}
	
	// Get invoice number by transaction id
	public function GetInvoiceTourOfflineByTransactionId($transactionId){
		$result = $this->InvoiceTourOfflineRepo->GetInvoiceTourOfflineByTransactionId($transactionId);
		return $result;
	}

	//=============== Confirmation & Invoice (RSVN) ===============//
    /*
        Get data to confirmation & invoice (print) 
        1. invoice
        2. tour
        3. hotel
        4. guest
        5. book by
        6. insurance
        7. commission
        8. note by
        // 9. other
    */
	public function GetInvoiceData($transactionId){
		$GetTransaction = $this->TransactionRepo->GetTransactionById($transactionId);
        $GetTransactionTour = $this->TransactionRepo->GetTransactionTourById($transactionId);
        $GetTransactionTourDetail = $this->TransactionRepo->GetTransactionTourDetail($GetTransactionTour[0]->id);
		$GetInvoiceTourOffline = $this->GetInvoiceTourOfflineByTransactionId($transactionId);

		$this->BookingData = new InvoiceTourOffline;

        $this->SetInvoiceData($GetInvoiceTourOffline);
        $this->SetTourData($GetTransaction,$GetTransactionTour);
        $this->SetHotelData($GetTransactionTour);
		$this->SetGuestData($GetTransactionTourDetail);
		$this->BookingData->paymentMode = $GetTransaction[0]->payment_mode;
		$this->BookingData->paymentCollect = $GetTransaction[0]->payment_collect;
		$this->BookingData->isServiceCharge = $GetTransaction[0]->is_service_charge==1?true:false;
		$this->BookingData->serviceCharge = number_format($GetTransaction[0]->service_charge);
        $this->BookingData->specialRequest = $GetTransactionTour[0]->special_request;
        $this->BookingData->specialRequestPrice = number_format($GetTransactionTour[0]->special_request_price);

		// Get acccount code
		$this->SetAccountCode($GetTransaction[0]->customer_code_id);

		// $this->BookingData->accountCode = '';
        $this->SetBookByData($GetTransaction);
        $this->SetInsuranceData($GetTransaction);
        $this->SetCommissionData($GetTransaction);
        $this->SetNoteByData($GetTransaction);
		$this->SetPrice($GetTransaction,$GetTransactionTour);
        // $this->BookingData->paymentMode = $GetTransaction[0]->payment_mode;
        // $this->BookingData->paymentCollect = $GetTransaction[0]->payment_collect;
        // $this->BookingData->isServiceCharge = $GetTransaction[0]->is_service_charge==1?true:false;
        // $this->BookingData->serviceCharge = $GetTransaction[0]->service_charge;
        // $this->BookingData->specialRequest = $GetTransaction[0]->special_request;

        return  $this->BookingData;
	}

    // 1. invoice
    public function SetInvoiceData($invoice){
        $bookData = new InvoiceTourOffline;
        $bookData->bookingNo = $invoice[0]->booking_number;
        $bookData->refBookingNo = $invoice[0]->booking_number_ref==null?"":$invoice[0]->booking_number_ref;
        $bookData->invoiceNo = $invoice[0]->invoice_number;

        return $this->BookingData->invoices = $bookData;
    }

    // 2. tour
    public function SetTourData($transaction,$tour){
		// Set tour travel time
		$travelTime = $this->TourRepo->GetTourTravelTimeByTourId($tour[0]->tour_id);

        $bookData = new InvoiceTourOffline;
        $bookData->name = $tour[0]->tour_code.' : '.$tour[0]->tour_title;
		$bookData->type = $tour[0]->tour_travel_time;
		$bookData->time = $travelTime[0]->travel_time_start.' - '.$travelTime[0]->travel_time_end;
		$bookData->standBy = $travelTime[0]->pickup_time;
        $bookData->date = \DateFormatFacade::SetFullDate($tour[0]->tour_travel_date);
        $bookData->privacy = $tour[0]->tour_privacy;
		$bookData->pax = $tour[0]->pax;
		$bookData->adult = $tour[0]->adult_pax;
		$bookData->child = $tour[0]->child_pax;
        $bookData->infant = $tour[0]->infant_pax;
        $bookData->discount = $tour[0]->discount_rate;
        $bookData->discountPrice = number_format($tour[0]->discount);

        return $this->BookingData->tours = $bookData;
    }

    // 3. hotel
    public function SetHotelData($hotel){
        $bookData = new InvoiceTourOffline;
        $bookData->name = $hotel[0]->hotel;
        $bookData->room = $hotel[0]->hotel_room;

        return $this->BookingData->hotel = $bookData;
    }

    // 4. guest
    public function SetGuestData($guest){
		// $bookData = new InvoiceTourOffline;
		

        // $guestArr = [];

        // foreach($guest as $value){
        //     $bookData = new InvoiceTourOffline;
        //     $bookData->name = $value->fullname;
        //     $bookData->ages = $value->ages;

        //     array_push($guestArr, $bookData);
        // }
        return $this->BookingData->guest = $guest[0]->fullname;
    }

    // 5. book by
    public function SetBookByData($bookBy){
		$bookBy = $bookBy[0]->book_by_name.' / '.$bookBy[0]->book_by_position;
        return $this->BookingData->bookBy = $bookBy;
    }

    // 6. insurance
    public function SetInsuranceData($insurance){
        $bookData = new InvoiceTourOffline;
        $bookData->isInsurance = $insurance[0]->is_insurance==1?true:false;
        $bookData->note = $insurance[0]->insurance_note;

        return $this->BookingData->insurance = $bookData;
    }

    // 7. commission
    public function SetCommissionData($commission){
        $bookData = new InvoiceTourOffline;
        $bookData->isCommission = $commission[0]->is_commission==1?true:false;
        $bookData->amount = number_format($commission[0]->commission);

        return $this->BookingData->commission = $bookData;
    }

    // 8. note by
    public function SetNoteByData($noteBy){
        $bookData = new InvoiceTourOffline;
        $bookData->name = $noteBy[0]->note_by;
        $bookData->date = \DateFormatFacade::SetShortDate($noteBy[0]->book_date);
        $bookData->time = \DateFormatFacade::SetTimeMeridiem($noteBy[0]->book_time);

        return $this->BookingData->noteBy = $bookData;
	}
	
	// account code
	public function SetAccountCode($accountCodeId){
		$accountCode = $this->AccountCodeRepo->GetAccountCodeById($accountCodeId);
		$setAccountCode = intval($accountCode[0]->code).'-'.$accountCode[0]->customer_name;

		return $this->BookingData->accountCode = $setAccountCode;
	}

	// price
	public function SetPrice($transaction,$transactionTour){
		$price = new InvoiceTourOffline;
		$price->adult = number_format($transactionTour[0]->adult_price);
		$price->adultAmount = number_format($transactionTour[0]->total_adult_price);
		$price->child = number_format($transactionTour[0]->child_price);
		$price->childAmount = number_format($transactionTour[0]->total_child_price);
		$price->singleRiding = number_format($transactionTour[0]->single_riding);
		// $price->specialRequest = $transactionTour[0]->special_request_price;
		// $price->serviceCharge = $transactionTour[0]->service_charge;
		$price->totalPrice = number_format($transaction[0]->amount);
		// $price->transaction = $transaction;
		// $price->transactionTour = $transactionTour;

		return $this->BookingData->prices = $price;
	}
}