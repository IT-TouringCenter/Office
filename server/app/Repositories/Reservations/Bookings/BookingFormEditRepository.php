<?php 
namespace App\Repositories\Reservations\Bookings;

use Carbon\Carbon;

use App\transaction as Transaction;

class BookingFormEditRepository{    

	public function __construct(Transaction $Transaction){
		$this->Transaction = $Transaction;
    }

    // Transactions model
    public function GetDataByTransaction($transactionId){
        $result = \DB::table('transactions')
                    ->where('id',$transactionId)
                    ->where('is_active',1)
					->get();
        return $result;
    }

    // Transaction_tour model
    public function GetDataByTransactionTour($transactionId){
        $result = \DB::table('transaction_tours')
                    ->where('transaction_id',$transactionId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Transaction_tour_detail model
    public function GetDataByTransactionTourDetail($transactionTourId){
        $result = \DB::table('transaction_tour_details')
                    ->where('transaction_tour_id',$transactionTourId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

    // Invoice_tour model
    public function GetDataByInvoiceTour($transactionId){
        $result = \DB::table('invoice_tours')
                    ->where('transaction_id',$transactionId)
                    ->where('is_active',1)
                    ->get();
        return $result;
    }

}