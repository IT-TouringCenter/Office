<?php
namespace App\Facades\Reservations\BookingFormEdit;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// Model
use App\transaction as Transaction;

// Repository
use App\Repositories\Reservations\Bookings\BookingFormEditRepository as BookingFormEditRepo;

class BookingFormEditClass{
	
	public function __construct(BookingFormEditRepo $BookingFormEditRepo){
        $this->BookingFormEditRepo = $BookingFormEditRepo;
    }

    /* =====================================
        Booking form (edit)
        Get data from model
            1) transactions
            2) transaction_tours
            3) transaction_tour_details
            4) invoice_tours
    ===================================== */

    public function GetBookingFormEdit($transactionId){
        $transaction = $this->BookingFormEditRepo->GetDataByTransaction($transactionId);
        if($transaction){
            $transactionTour = $this->BookingFormEditRepo->GetDataByTransactionTour($transactionId);
            $transactionTourDetail = $this->BookingFormEditRepo->GetDataByTransactionTourDetail($transactionTour[0]->id);
            $invoiceTour = $this->BookingFormEditRepo->GetDataByInvoiceTour($transactionId);

            //
            if($transactionTour[0]->is_special_request_operator==2){
                $isSpecialRequestOperator = '-';
            }else{
                $isSpecialRequestOperator = '+';
            }

            $this->booking = new Transaction;
            $this->booking->transId = intval($transactionId);
            $this->booking->bookingInfo = $this->SetBookingInfo($transaction, $transactionTour);
            $this->booking->hotelInfo = $this->SetHotelInfo($transactionTour);
            $this->booking->guestInfo = $this->SetGuestInfo($transactionTourDetail);
            $this->booking->paymentInfo = $this->SetPaymentInfo($transaction);
            $this->booking->bookBy = $this->SetBookBy($transaction,$transactionTour);
            $this->booking->insurance = $this->SetInsurance($transaction);
            $this->booking->commission = $this->SetCommission($transaction);
            $this->booking->noteBy = $this->SetNoteBy($transaction);
            $this->booking->summary = $this->SetSummary($transaction, $transactionTour);
            $this->booking->isSpecialRequestOperator = $isSpecialRequestOperator;
            $this->booking->specialRequest = $transactionTour[0]->special_request;
            $this->booking->specialRequestPrice = intval($transactionTour[0]->special_request_price);
            $this->booking->invoiceRef = $this->SetInvoiceRef($invoiceTour);
            
            return $this->booking;
        }else{
            return 'Error query!';
        }
    }

    // Set bookingInfo {}
    public function SetBookingInfo($transaction, $transactionTour){
        $booking = new Transaction;
        $booking->tourId = intval($transactionTour[0]->id);
        $booking->tourCode = $transactionTour[0]->tour_code;
        $booking->tourName = $transactionTour[0]->tour_title;
        $booking->tourPrivacy = $transactionTour[0]->tour_privacy;
        $booking->travelTime = $transactionTour[0]->tour_travel_time;
        $booking->travelDate = $transactionTour[0]->tour_travel_date;
        $booking->rateTwoPax = intval($transactionTour[0]->rate_two_pax);
        $booking->pax = intval($transactionTour[0]->pax);
        $booking->adultPax = intval($transactionTour[0]->adult_pax);
        $booking->childPax = intval($transactionTour[0]->child_pax);
        $booking->infantPax = intval($transactionTour[0]->infant_pax);
        $booking->isServiceCharge = $transaction[0]->is_service_charge==1?true:false;

        return $booking;
    }

    // Set hotelInfo {}
    public function SetHotelInfo($transactionTour){
        $hotel = new Transaction;
        $hotel->name = $transactionTour[0]->hotel;
        $hotel->room = $transactionTour[0]->hotel_room;

        return $hotel;
    }

    // Set guestInfo {}
    public function SetGuestInfo($transactionTourDetail){
        $guestArr = [];
        foreach($transactionTourDetail as $value){
            $guest = new Transaction;
            $guest->name = $value->fullname;
            
            switch($value->ages){
                case 'Adult' : $guest->isAges = 1; break;
                case 'Child' : $guest->isAges = 2; break;
                case 'Infant' : $guest->isAges = 3; break;
            }
            array_push($guestArr, $guest);
        }
        return $guestArr;
    }

    // Set paymentInfo {}
    public function SetPaymentInfo($transaction){
        $payment = new Transaction;
        $payment->tourPrice = $transaction[0]->payment_mode;
        $payment->paymentCollect = $transaction[0]->payment_collect;

        return $payment;
    }

    // Set bookBy {}
    public function SetBookBy($transaction,$transactionTour){
        // return $transaction;
        $bookBy = new Transaction;
        $bookBy->name = $transaction[0]->book_by_name;
        $bookBy->position = $transaction[0]->book_by_position;
        $bookBy->code = $transaction[0]->customer_code_id;
        $bookBy->hotel = $transaction[0]->book_by_hotel;
        $bookBy->tel = $transaction[0]->book_by_tel;
        $bookBy->otaCode = $transactionTour[0]->ota_code;

        if(strpos($bookBy->otaCode,'GYG')>=0){
            $ota = 'Get Your Guide';
        }else if(strpos($bookBy->otaCode,'BR-')>=0){
            $ota = 'Viator';
        }else{
            $ota = '-';
        }
        $bookBy->ota = $ota;

        return $bookBy;
    }

    // Set insurance {}
    public function SetInsurance($transaction){
        $insurance = new Transaction;
        $insurance->isInsurance = $transaction[0]->is_insurance==1?true:false;
        $insurance->insuranceReason = $transaction[0]->insurance_note;

        return $insurance;
    }

    // Set commission {}
    public function SetCommission($transaction){
        $commission = new Transaction;
        $commission->isCommission = $transaction[0]->is_commission==1?true:false;
        $commission->amount = intval($transaction[0]->commission);

        return $commission;
    }

    // Set noteBy {}
    public function SetNoteBy($transaction){
        $noteBy = new Transaction;
        $noteBy->name = $transaction[0]->note_by;

        return $noteBy;
    }

    // Set summary {}
    public function SetSummary($transaction, $transactionTour){
        $summary = new Transaction;
        $summary->adultPrice = intval($transactionTour[0]->adult_price);
        $summary->childPrice = intval($transactionTour[0]->child_price);
        $summary->totalAdultPrice = intval($transactionTour[0]->total_adult_price);
        $summary->totalChildPrice = intval($transactionTour[0]->total_child_price);
        $summary->singleRidingPax = intval($transactionTour[0]->single_riding_pax);
        $summary->singleRiding = intval($transactionTour[0]->single_riding);
        $summary->serviceCharge = intval($transaction[0]->service_charge);
        $summary->depositPrice = intval($transactionTour[0]->deposit_price);
        $summary->discount = intval($transactionTour[0]->discount_rate);
        $summary->discountPrice = intval($transactionTour[0]->discount);
        // $summary->totalPrice = intval($transactionTour[0]->total_price);
        $summary->amount = intval($transactionTour[0]->amount);

        return $summary;
    }

    // Set invoiceRef {}
    public function SetInvoiceRef($invoiceTour){
        $invoice = new Transaction;
        $invoice->id = intval($invoiceTour[0]->id);
        $invoice->number = $invoiceTour[0]->booking_number;

        return $invoice;
    }
}