<?php
namespace App\Facades\Reservations\BookingStatistics;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// Model
use App\transaction as Transaction;

// Repository
use App\Repositories\Reservations\Accounts\AccountRepository as AccountRepo;
use App\Repositories\Reservations\TransactionRepository as TransactionRepo;
use App\Repositories\Reservations\Invoices\InvoiceTourRepository as InvoiceTourRepo;

class BookingStatisticsClass{
	
	public function __construct(TransactionRepo $TransactionRepo, InvoiceTourRepo $InvoiceTourRepo, AccountRepo $AccountRepo){
        $this->TransactionRepo = $TransactionRepo;
        $this->InvoiceTourRepo = $InvoiceTourRepo;
        $this->AccountRepo = $AccountRepo;
    }

    /* -----------------------------------------------------------------------------------------------------
    Get booking data to schedule
    1. Transaction
    2. Transaction tour
    3. Invoice tour
    ----------------------------------------------------------------------------------------------------- */

    // 1. Transaction
    public function GetBookingStatistics(){
        // set
        $transaction = $this->TransactionRepo->GetTransactionAll();
        if($transaction==null){
            return null;
        }
        $transactionArr = [];

        foreach($transaction as $value){
            $this->transaction = new Transaction;
            $TransactionTour = $this->GetTransactionTourById($value->id);
            $Invoice = $this->GetInvoiceTour($value->id);
            // $TransactionTourDetail = $this->GetTransactionTourDetailById($TransactionTour[0]->id);

            if($TransactionTour && $this->transaction->bookingId!=''){
                $tourName = $TransactionTour[0]->tour_code.' : '.$TransactionTour[0]->tour_title;
                $subTour = substr($tourName,0,25);

                $this->transaction->transactionId = $value->id;
                $this->transaction->tourName = $subTour.'...';
                $this->transaction->tourFullname = $tourName;
                $this->transaction->transactionTourId = $TransactionTour[0]->id;
                $this->transaction->tourPrivacy = $TransactionTour[0]->tour_privacy;
                $this->transaction->tourTravel = $TransactionTour[0]->tour_travel_date;
                $this->transaction->tourPax = $TransactionTour[0]->pax;
                $this->transaction->hotel = $TransactionTour[0]->hotel;
                $this->transaction->hotelRoom = $TransactionTour[0]->hotel_room;
                $this->transaction->bookBy = $value->book_by_name;
                $this->transaction->noteBy = $value->note_by;
                $this->transaction->insurance = $value->is_insurance==1?true:false;
                $this->transaction->price = $value->amount;
                $this->GetTransactionTourDetailById($TransactionTour[0]->id);

                array_push($transactionArr, $this->transaction);
            }else{
                $this->transaction->transactionId = $value->id;
                $this->transaction->tourName = '';
                $this->transaction->tourFullname = '';
                $this->transaction->tourPrivacy = '';
                $this->transaction->tourTravel = '';
                $this->transaction->tourPax = '';
                $this->transaction->hotel = '';
                $this->transaction->hotelRoom = '';
                $this->transaction->bookBy = $value->book_by_name;
                $this->transaction->noteBy = $value->note_by;
                $this->transaction->insurance = $value->is_insurance==1?true:false;
                $this->transaction->price = $value->amount;

                // array_push($transactionArr, $this->transaction);
            }
        }
        return $transactionArr;
    }

    // 2. Transaction Tour
    public function GetTransactionTourById($transactionId){
        $result = $this->TransactionRepo->GetTransactionTourById($transactionId);
        if($result){
            return $result;
        }else{
            return null;
        }
    }

    // 3. Invoice tour
    public function GetInvoiceTour($transactionId){
        $result = $this->InvoiceTourRepo->GetInvoiceTourByTransactionId($transactionId);
        if($result){
            $this->transaction->bookingId = $result[0]->booking_number;
            $this->transaction->invoiceId = $result[0]->invoice_number;
            $this->transaction->isRevised = $result[0]->is_revised==1?true:false;
        }else{
            $this->transaction->bookingId = '';
            $this->transaction->invoiceId = '';
            $this->transaction->isRevised = '';
        }
    }

    // 4. Transaction tour detail
    public function GetTransactionTourDetailById($transaction_tour_id){
        $result = $this->TransactionRepo->GetTransactionTourDetail($transaction_tour_id);
        if($result){
            $this->transaction->guestName = $result[0]->fullname;
        }else{
            $this->transaction->guestName = '';
        }
    }

    //=====================================================================
    // Affiliate booked
    // 5. Transaction by account id
    public function GetBookedByAccountId($accountData){
        // get data
        $token = array_get($accountData,'token');
        $typeId = array_get($accountData,'type');
        $transactionArr = [];

        // check accounts
        $getAccount = $this->AccountRepo->GetAccountByTokenAndType($token,$typeId);
        if(empty($getAccount)){
            return 'null 1';
        }

        $accountId = $getAccount[0]->id;

        // check type
        $accountType = $getAccount[0]->account_type_id;
        if($accountType=='5'){ // manager
            $transaction = $this->TransactionRepo->GetAllTransaction(); // manager
        }else{
            $transaction = $this->TransactionRepo->GetTransactionByAccountId($accountId);    
        }

        // get transactions
        if(empty($transaction)){
            return 'null 2';
        }

        // get transaction_tours
        foreach($transaction as $value){
            $this->transaction = new Transaction;
            $TransactionTour = $this->GetTransactionTourById($value->id);
            $Invoice = $this->GetInvoiceTour($value->id);
            // $TransactionTourDetail = $this->GetTransactionTourDetailById($TransactionTour[0]->id);

            if($TransactionTour && $this->transaction->bookingId!=''){
                $tourName = $TransactionTour[0]->tour_code.' : '.$TransactionTour[0]->tour_title;
                $subTour = substr($tourName,0,25);

                $this->transaction->transactionId = $value->id;
                $this->transaction->tourName = $subTour.'...';
                $this->transaction->tourFullname = $tourName;
                $this->transaction->tourPrivacy = $TransactionTour[0]->tour_privacy;
                $this->transaction->tourTravel = \DateFormatFacade::SetShortDate($TransactionTour[0]->tour_travel_date);
                $this->transaction->tourPax = $TransactionTour[0]->pax;
                $this->transaction->hotel = $TransactionTour[0]->hotel;
                $this->transaction->hotelRoom = $TransactionTour[0]->hotel_room;
                $this->transaction->bookDate = \DateFormatFacade::SetShortDate($value->book_date);
                $this->transaction->bookBy = $value->book_by_name;
                $this->transaction->noteBy = $value->note_by;
                $this->transaction->insurance = $value->is_insurance==1?true:false;
                $this->transaction->price = $value->amount;
                $this->GetTransactionTourDetailById($TransactionTour[0]->id);

                array_push($transactionArr, $this->transaction);
            }else{
                $this->transaction->transactionId = $value->id;
                $this->transaction->tourName = '';
                $this->transaction->tourFullname = '';
                $this->transaction->tourPrivacy = '';
                $this->transaction->tourTravel = '';
                $this->transaction->tourPax = '';
                $this->transaction->hotel = '';
                $this->transaction->hotelRoom = '';
                $this->transaction->bookDate = \DateFormatFacade::SetShortDate($value->book_date);
                $this->transaction->bookBy = $value->book_by_name;
                $this->transaction->noteBy = $value->note_by;
                $this->transaction->insurance = $value->is_insurance==1?true:false;
                $this->transaction->price = $value->amount;

                // array_push($transactionArr, $this->transaction);
            }
        }
        return $transactionArr;
    }
}