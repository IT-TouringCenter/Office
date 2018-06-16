<?php
namespace App\Facades\Reservations\Invoices;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Reservations\Invoices\InvoiceTourRepository as InvoiceTourRepo;
use App\Repositories\Reservations\TransactionRepository as TransactionRepo;
use App\Repositories\Reservations\Tours\TourRepository as TourRepo;
use App\Repositories\Reservations\Accounts\AccountCodeRepository as AccountCodeRepo;
use App\Repositories\Reservations\Payments\PaymentModeRepository as PaymentModeRepo;

use App\invoice_tour as InvoiceTour;

class InvoiceTourClass{

	public function __construct(InvoiceTourRepo $InvoiceTourRepo, TransactionRepo $TransactionRepo, TourRepo $TourRepo, AccountCodeRepo $AccountCodeRepo, PaymentModeRepo $PaymentModeRepo){
		$this->InvoiceTourRepo = $InvoiceTourRepo;
		$this->TransactionRepo = $TransactionRepo;
		$this->TourRepo = $TourRepo;
        $this->AccountCodeRepo = $AccountCodeRepo;
        $this->PaymentModeRepo = $PaymentModeRepo;
	}

	// Get invoice number
	public function GetLastInvoiceNumber(){
        $result = $this->InvoiceTourRepo->GetLastInvoiceNumber();
        return $result;
	}

	// Get invoice number by transaction id
	public function GetInvoiceTourByTransactionId($transactionId){
		$result = $this->InvoiceTourRepo->GetInvoiceTourByTransactionId($transactionId);
		return $result;
	}

    // Get invoice reference id by invoice id
    public function GetReferenceInvoiceTourByTransactionId($transactionRefId){
        $result = $this->invoiceTourRepo->GetReferenceInvoiceTourByTransactionId($transactionRefId);
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
		$GetInvoiceTour = $this->GetInvoiceTourByTransactionId($transactionId);
        $GetPaymentMode = $this->PaymentModeRepo->GetPaymentModeByMode($GetTransaction[0]->payment_mode);

		$this->BookingData = new InvoiceTour;

        $this->SetInvoiceData($GetInvoiceTour);
        $this->SetTourData($GetTransaction,$GetTransactionTour);
        $this->SetHotelData($GetTransactionTour);
		$this->SetGuestData($GetTransactionTourDetail);
        $this->BookingData->paymentMode = $GetTransaction[0]->payment_mode;
        $this->BookingData->paperColor = $GetPaymentMode[0]->paper_color;
		$this->BookingData->paymentCollect = $GetTransaction[0]->payment_collect;
		$this->BookingData->isServiceCharge = $GetTransaction[0]->is_service_charge==1?true:false;
		$this->BookingData->serviceCharge = number_format($GetTransaction[0]->service_charge,2);
        $this->BookingData->specialRequest = $GetTransactionTour[0]->special_request;
        $this->BookingData->specialRequestPrice = number_format($GetTransactionTour[0]->special_request_price,2);
        $this->BookingData->isSpecialRequestOperator = $GetTransactionTour[0]->is_special_request_operator;
        
        if($GetTransactionTour[0]->ota_code=='' || empty($GetTransactionTour[0]->ota_code)){
            $this->BookingData->otaCode = null;
            $this->BookingData->ota = null;
        }else{
            $this->BookingData->otaCode = $GetTransactionTour[0]->ota_code;
            if($this->BookingData->otaCode=='GYG%'){
                $this->BookingData->ota = 'GYG';
            }else if($this->BookingData->otaCode=='BR-%'){
                $this->BookingData->ota = 'Viator';
            }
        }

		// Get acccount code
        $this->SetAccountCode($GetTransaction);

		// $this->BookingData->accountCode = '';
        $this->SetBookByData($GetTransaction);
        $this->SetInsuranceData($GetTransaction);
        $this->SetCommissionData($GetTransaction);
        $this->SetNoteByData($GetTransaction);
		$this->SetPrice($GetTransaction,$GetTransactionTour);

        return  $this->BookingData;
	}

    // 1. invoice
    public function SetInvoiceData($invoice){
        $bookData = new InvoiceTour;
        $bookData->bookingNo = $invoice[0]->booking_number;
        $bookData->refBookingNo = $invoice[0]->booking_number_ref==null?"":$invoice[0]->booking_number_ref;
        $bookData->invoiceNo = $invoice[0]->invoice_number;

        return $this->BookingData->invoices = $bookData;
    }

    // 2. tour
    public function SetTourData($transaction,$tour){
		// Set tour travel time
		$travelTime = $this->TourRepo->GetTourTravelTimeByTourId($tour[0]->tour_id);

        $bookData = new InvoiceTour;
        $bookData->name = $tour[0]->tour_code.' : '.$tour[0]->tour_title;
        $bookData->code = $tour[0]->tour_code;
		$bookData->type = $tour[0]->tour_travel_time;
        $bookData->time = $travelTime[0]->travel_time_start.' - '.$travelTime[0]->travel_time_end;
        $bookData->pickupTime = $travelTime[0]->pickup_time.' - '.$travelTime[0]->travel_time_start;
		$bookData->standBy = $travelTime[0]->pickup_time;
        // $bookData->date = \DateFormatFacade::SetFullDate($tour[0]->tour_travel_date);
        $bookData->date = $tour[0]->tour_travel_date;
        $bookData->privacy = $tour[0]->tour_privacy;
        $bookData->singleRidingPax = $tour[0]->single_riding_pax;
		$bookData->pax = $tour[0]->pax;
		$bookData->adult = $tour[0]->adult_pax;
		$bookData->child = $tour[0]->child_pax;
        $bookData->infant = $tour[0]->infant_pax;
        $bookData->discount = $tour[0]->discount_rate;
        $bookData->discountPrice = number_format($tour[0]->discount,2);

        return $this->BookingData->tours = $bookData;
    }

    // 3. hotel
    public function SetHotelData($hotel){
        $bookData = new InvoiceTour;
        $bookData->name = $hotel[0]->hotel;
        $bookData->room = $hotel[0]->hotel_room;

        return $this->BookingData->hotel = $bookData;
    }

    // 4. guest
    public function SetGuestData($guest){
        return $this->BookingData->guest = $guest[0]->fullname;
    }

    // 5. book by
    public function SetBookByData($bookBy){
        // name null
        if($bookBy[0]->book_by_name=='' || $bookBy[0]->book_by_name==null){
            if($bookBy[0]->book_by_position!='' || $bookBy[0]->book_by_position!=null){
                $bookby = $bookBy[0]->book_by_position;
            }else{
                $bookby = '';
            }
        }else{
            if($bookBy[0]->book_by_position!='' || $bookBy[0]->book_by_position!=null){
                $bookBy = $bookBy[0]->book_by_name.' / '.$bookBy[0]->book_by_position;
            }else{
                $bookBy = $bookBy[0]->book_by_name;
            }
        }

        // position null
        // if($bookBy[0]->book_by_position=='' || $bookBy[0]->book_by_position==null){
        //     $bookby = $bookBy[0]->book_by_name;
        // }
		// $bookBy = $bookBy[0]->book_by_name.' / '.$bookBy[0]->book_by_position;
        return $this->BookingData->bookBy = $bookBy;
    }

    // 6. insurance
    public function SetInsuranceData($insurance){
        $bookData = new InvoiceTour;
        $bookData->isInsurance = $insurance[0]->is_insurance==1?true:false;
        $bookData->note = $insurance[0]->insurance_note;

        return $this->BookingData->insurance = $bookData;
    }

    // 7. commission
    public function SetCommissionData($commission){
        $bookData = new InvoiceTour;
        $bookData->isCommission = $commission[0]->is_commission==1?true:false;
        $bookData->amount = number_format($commission[0]->commission,2);

        return $this->BookingData->commission = $bookData;
    }

    // 8. note by
    public function SetNoteByData($noteBy){
        $bookData = new InvoiceTour;
        $bookData->name = $noteBy[0]->note_by;
        $bookData->date = \DateFormatFacade::SetShortDate($noteBy[0]->book_date);
        $bookData->time = \DateFormatFacade::SetTimeMeridiem($noteBy[0]->book_time);

        return $this->BookingData->noteBy = $bookData;
	}
	
	// account code
    public function SetAccountCode($transaction){
        if($transaction[0]->book_by_hotel){
            $setAccountCode = $transaction[0]->customer_code_id.'-'.$transaction[0]->book_by_hotel;    
        }else{
            $setAccountCode = '-';
        }
        // $setAccountCode = $transaction[0]->customer_code_id.'-'.$transaction[0]->book_by_hotel;
        return $this->BookingData->accountCode = $setAccountCode;
	}

	// price
	public function SetPrice($transaction,$transactionTour){
        $singleRiding = $this->TourRepo->GetSingleRiding($transactionTour[0]->tour_id);

		$this->price = new InvoiceTour;
		$this->price->adult = number_format($transactionTour[0]->adult_price,2);
		$this->price->adultAmount = number_format($transactionTour[0]->total_adult_price,2);
		$this->price->child = number_format($transactionTour[0]->child_price,2);
        $this->price->childAmount = number_format($transactionTour[0]->total_child_price,2);
        $this->price->singleRidingPerPax = number_format($singleRiding->single_riding,2);
        $this->price->singleRiding = number_format($transactionTour[0]->single_riding,2);
        $this->price->specialChargePrice = number_format($transactionTour[0]->special_charge_price,2);
        $this->price->depositPrice = number_format($transactionTour[0]->deposit_price,2);
		$this->price->totalPrice = number_format($transaction[0]->amount,2);
        $this->SetPayment($transaction);
		return $this->BookingData->prices = $this->price;
    }
    
    // payment
    public function SetPayment($transaction){
        // $payment = new InvoiceTour;
        $discount = '';
        if(strpos($transaction[0]->payment_mode,'Discount')){
            $discount = $transaction[0]->payment_mode;
        }
        $this->price->discountMode = $discount;
        $this->price->paymentMode = $transaction[0]->payment_mode;
    }
}