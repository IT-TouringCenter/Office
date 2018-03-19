<?php
namespace App\Facades\Reservations\BookingStatistics;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// Model
use App\transaction as Transaction;

// Repository
use App\Repositories\Reservations\TransactionRepository as TransactionRepo;
use App\Repositories\Reservations\Invoices\InvoiceTourRepository as InvoiceTourOfflineRepo;

class BookingStatisticsClass{
	
	public function __construct(TransactionRepo $TransactionRepo, InvoiceTourOfflineRepo $InvoiceTourOfflineRepo){
        $this->TransactionRepo = $TransactionRepo;
        $this->InvoiceTourOfflineRepo = $InvoiceTourOfflineRepo;
    }

    /* -----------------------------------------------------------------------------------------------------
    Get booking data to schedule
    1. Transaction
    2. Transaction tour
    3. Invoice tour offline
    ----------------------------------------------------------------------------------------------------- */

    // 1. Transaction
    public function GetBookingStatistics(){
        $transaction = $this->TransactionRepo->GetTransactionAll();
        $transactionArr = [];

        foreach($transaction as $value){
            $this->transaction = new Transaction;
            $TransactionTour = $this->GetTransactionTourById($value->id);
            $InvoiceTourOffline = $this->GetInvoiceTourOffline($value->id);
            $TransactionTourDetail = $this->GetTransactionTourDetailById($TransactionTour[0]->id);

            $this->transaction->transactionId = $value->id;
            $this->transaction->bookingId = $InvoiceTourOffline[0]->booking_number;
            $this->transaction->invoiceId = $InvoiceTourOffline[0]->invoice_number;
            $this->transaction->tourName = $TransactionTour[0]->tour_code.' : '.$TransactionTour[0]->tour_title;
            $this->transaction->tourPrivacy = $TransactionTour[0]->tour_privacy;
            $this->transaction->tourTravel = $TransactionTour[0]->tour_travel_date;
            $this->transaction->tourPax = $TransactionTour[0]->pax;
            $this->transaction->hotel = $TransactionTour[0]->hotel;
            $this->transaction->hotelRoom = $TransactionTour[0]->hotel_room;
            $this->transaction->bookBy = $value->book_by_name;
            $this->transaction->noteBy = $value->note_by;
            $this->transaction->insurance = $value->is_insurance==1?true:false;
            $this->transaction->price = $value->amount;
            $this->transaction->guestName = $TransactionTourDetail[0]->fullname;
            

            array_push($transactionArr, $this->transaction);
        }
        return $transactionArr;
    }

    // 2. Transaction Tour
    public function GetTransactionTourById($transactionId){
        $result = $this->TransactionRepo->GetTransactionTourById($transactionId);
        return $result;
    }

    // 3. Invoice tour offline
    public function GetInvoiceTourOffline($transactionId){
        $result = $this->InvoiceTourOfflineRepo->GetInvoiceTourOfflineByTransactionId($transactionId);
        return $result;
    }

    // 4. Transaction tour detail
    public function GetTransactionTourDetailById($transaction_tour_id){
        $result = $this->TransactionRepo->GetTransactionTourDetail($transaction_tour_id);
        return $result;
    }
}