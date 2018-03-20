<?php
namespace App\Facades\Reservations\BookingForms;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// Model
use App\tour as Tour;
use App\customer_code as CustomerCode;

// Repository
use App\Repositories\Reservations\Tours\TourRepository as TourRepo;
use App\Repositories\Reservations\Accounts\AccountCodeRepository as AccountCodeRepo;
use App\Repositories\Reservations\TransactionRepository as TransactionRepo;

class BookingFormClass{
	
	public function __construct(TourRepo $TourRepo, AccountCodeRepo $AccountCodeRepo, TransactionRepo $TransactionRepo){
        $this->TourRepo = $TourRepo;
        $this->AccountCodeRepo = $AccountCodeRepo;
        $this->TransactionRepo = $TransactionRepo;
	}

    // Data for booking (Reservation system)
    // Get tour data booking form (Fill data)
	public function GetDataBooking(){
		$result = $this->TourRepo->GetTourDataToBooking();
        
        $this->bookingData = new Tour;
        $tourArr = [];
        foreach($result as $value){
            $this->tour = new Tour;
            $this->tour->id = $value->id;
            $this->tour->code = $value->code;
            $this->tour->title = $value->title;
            $this->GetTourTravelTime($value->id);
            $this->GetTourPrivacy($value->id);

            array_push($tourArr, $this->tour);
        }
        $this->bookingData->tourInfo = $tourArr;

        // Get account code
        // $this->GetAccountCode();
        // $this->bookingData->accountCode = $account;
        return $this->bookingData;
	}

    // Get data tour travel time
    public function GetTourTravelTime($tourId){
        $travelTime = $this->TourRepo->GetTourTravelTimeByTourId($tourId);

        $travelTimeArr = [];
        foreach($travelTime as $value){
            $this->travelTime = new Tour;
            $this->travelTime->id = $value->id;
            $this->travelTime->meridiem = $value->meridiem;
            $this->travelTime->travelTimeStart = $value->travel_time_start;
            $this->travelTime->travelTimeEnd = $value->travel_time_end;
            $this->travelTime->pickupTime = $value->pickup_time;
            
            array_push($travelTimeArr, $this->travelTime);
        }
        return $this->tour->times = $travelTimeArr;
    }

    // Get tour privacy
    public function GetTourPrivacy($tourId){
        $tourPrivacy = $this->TourRepo->GetTourPrivacy();

        $tourPrivacyArr = [];
        foreach($tourPrivacy as $value){
            $this->privacy = new Tour;
            $this->privacy->id = $value->id;
            $this->privacy->privacy = $value->privacy;
            $this->GetTourPax($tourId, $value->id);

            array_push($tourPrivacyArr, $this->privacy);
        }
        return $this->tour->privacies = $tourPrivacyArr;
    }

    // Get tour pax
    public function GetTourPax($tourId, $privacyId){
        $tourPax = $this->TourRepo->GetPaxbyTourPrivacyId($tourId, $privacyId);

        $tourPaxArr = [];
        foreach($tourPax as $value){
            $this->tourPax = new Tour;
            $this->GetTourPaxDetail($value->tour_pax_id);
            $this->GetPaymentAndPrice($tourId, $privacyId, $value->tour_pax_id);

            array_push($tourPaxArr, $this->tourPax);
        }
        return $this->privacy->paxs = $tourPaxArr;
    }

    // Get tour pax detail
    public function GetTourPaxDetail($paxId){
        $paxDetail = $this->TourRepo->GetPaxDetail($paxId);

        $TourPaxDetail = new Tour;
        $TourPaxDetail->id = $paxDetail[0]->id;
        $TourPaxDetail->min = $paxDetail[0]->min_pax;
        $TourPaxDetail->max = $paxDetail[0]->max_pax;

        return $this->tourPax = $TourPaxDetail;
    }

    // Get payment mode
    public function GetPaymentAndPrice($tourId,$privacyId,$paxId){
        $payment = $this->TourRepo->GetPaymentId($tourId,$privacyId,$paxId);

        $tourPriceArr = [];
        foreach($payment as $value){
            $this->tourPrice = new Tour;
            $this->GetPaymentMode($value->payment_mode_id);
            $this->GetTourPrice($tourId,$privacyId,$paxId,$value->payment_mode_id);

            array_push($tourPriceArr, $this->tourPrice);
        }
        return $this->tourPax->tourPrices = $tourPriceArr;
    }

    public function GetPaymentMode($paymentModeId){
        $paymentMode = $this->TourRepo->GetPaymentMode($paymentModeId);
        return $this->tourPrice->type = $paymentMode[0]->mode;
    }

    // Get tour price
    public function GetTourPrice($tourId,$tourPrivacyId,$paxId,$paymentModeId){
        $tourPrice = $this->TourRepo->GetTourPrice($tourId,$tourPrivacyId,$paxId,$paymentModeId);
        return $this->tourPrice->prices = $tourPrice;
    }

    //================ Account code hotel ===================/
    // Get account code
    public function GetAccountCode(){
        $accountCode = $this->AccountCodeRepo->GetAccountCode();

        // $accCode = new CustomerCode;
        $accountCodeArr = [];
        foreach($accountCode as $value){
            $this->accountCode = new CustomerCode;
            $this->accountCode->code = intval($value->code);
            $this->accountCode->hotel = $value->customer_name;

            array_push($accountCodeArr, $this->accountCode);
        }
        return $accountCodeArr;
    }

    //=============== Booking Form (RSVN) ===============//
    /*
        Get data to Booking Form 
        1. invoice
        2. tour
        3. hotel
        4. guest
        5. book by
        6. insurance
        7. commission
        8. note by
        9. other
    */
    
    public function GetBookingFormData($transactionId){
        $GetTransaction = $this->TransactionRepo->GetTransactionById($transactionId);
        $GetTransactionTour = $this->TransactionRepo->GetTransactionTourById($transactionId);
        $GetTransactionTourDetail = $this->TransactionRepo->GetTransactionTourDetail($GetTransactionTour[0]->id);
        $GetInvoiceTourOffline = \InvoiceBookingFacade::GetInvoiceTourOfflineByTransactionId($transactionId);

        $this->BookingData = new Tour;

        $this->SetInvoiceData($GetInvoiceTourOffline);
        $this->SetTourData($GetTransaction,$GetTransactionTour);
        $this->SetHotelData($GetTransactionTour);
        $this->SetGuestData($GetTransactionTourDetail);
        $this->SetBookByData($GetTransaction);
        $this->SetInsuranceData($GetTransaction);
        $this->SetCommissionData($GetTransaction);
        $this->SetNoteByData($GetTransaction);

        $this->BookingData->paymentMode = $GetTransaction[0]->payment_mode;
        $this->BookingData->paymentCollect = $GetTransaction[0]->payment_collect;
        $this->BookingData->isServiceCharge = $GetTransaction[0]->is_service_charge==1?true:false;
        $this->BookingData->serviceCharge = $GetTransaction[0]->service_charge;
        $this->BookingData->specialRequest = $GetTransactionTour[0]->special_request;
        $this->BookingData->specialRequestPrice = $GetTransactionTour[0]->special_request_price;

        return  $this->BookingData;
    }

    // 1. invoice
    public function SetInvoiceData($invoice){
        $bookData = new Tour;
        // $bookData->booking = $invoice;
        $bookData->bookingNo = $invoice[0]->booking_number;
        $bookData->refBookingNo = $invoice[0]->booking_number_ref==null?"":$invoice[0]->booking_number_ref;
        $bookData->invoiceNo = $invoice[0]->invoice_number;

        return $this->BookingData->invoices = $bookData;
    }

    // 2. tour
    public function SetTourData($transaction,$tour){
        $bookData = new Tour;
        $bookData->name = $tour[0]->tour_code.' : '.$tour[0]->tour_title;
        $bookData->type = $tour[0]->tour_travel_time;
        $bookData->date = \DateFormatFacade::SetFullDate($tour[0]->tour_travel_date);
        $bookData->privacy = $tour[0]->tour_privacy;
        $bookData->pax = $tour[0]->pax;
        $bookData->discount = $tour[0]->discount_rate;
        $bookData->discountPrice = number_format($tour[0]->discount);

        return $this->BookingData->tours = $bookData;
    }

    // 3. hotel
    public function SetHotelData($hotel){
        $bookData = new Tour;
        $bookData->name = $hotel[0]->hotel;
        $bookData->room = $hotel[0]->hotel_room;

        return $this->BookingData->hotel = $bookData;
    }

    // 4. guest
    public function SetGuestData($guest){
        $guestArr = [];

        foreach($guest as $value){
            $bookData = new Tour;
            $bookData->name = $value->fullname;
            $bookData->ages = $value->ages;

            array_push($guestArr, $bookData);
        }
        return $this->BookingData->guest = $guestArr;
    }

    // 5. book by
    public function SetBookByData($bookBy){
        $bookData = new Tour;
        $bookData->name = $bookBy[0]->book_by_name;
        $bookData->position = $bookBy[0]->book_by_position;
        $bookData->tel = $bookBy[0]->book_by_tel;

        return $this->BookingData->bookBy = $bookData;
    }

    // 6. insurance
    public function SetInsuranceData($insurance){
        $bookData = new Tour;
        $bookData->isInsurance = $insurance[0]->is_insurance==1?true:false;
        $bookData->note = $insurance[0]->insurance_note;

        return $this->BookingData->insurance = $bookData;
    }

    // 7. commission
    public function SetCommissionData($commission){
        $bookData = new Tour;
        $bookData->isCommission = $commission[0]->is_commission==1?true:false;
        $bookData->amount = $commission[0]->commission;

        return $this->BookingData->commission = $bookData;
    }

    // 8. note by
    public function SetNoteByData($noteBy){
        $bookData = new Tour;
        $bookData->name = $noteBy[0]->note_by;
        $bookData->date = \DateFormatFacade::SetShortDate($noteBy[0]->book_date);
        $bookData->time = \DateFormatFacade::SetTimeMeridiem($noteBy[0]->book_time);

        return $this->BookingData->noteBy = $bookData;
    }
}