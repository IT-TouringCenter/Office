<?php 
namespace App\Repositories\Reservations\Invoices;

class InvoiceTourRepository{    

	public function __construct(){
		
	}

	// Get invoice tour offline
	public function GetLastInvoiceNumber(){
                $result = \DB::table('invoice_tour_offlines')
                                ->select('booking_number')
                                ->where('is_active',1)
                                ->orderBy('id','desc')
                                ->first();
                return $result;
	}

        // Get invoice tour offline by transaction id
        public function GetInvoiceTourOfflineByTransactionId($transactionId){
                $result = \DB::table('invoice_tour_offlines')
                                ->where('transaction_id',$transactionId)
                                ->where('is_active',1)
                                ->get();
                return $result;
        }

        // Get reference invoice tour offline by invoice id
        public function GetReferenceInvoiceTourOfflineByTransactionId($transactionRefId){
                $result = \DB::table('invoice_tour_offlines')
                                ->where('transaction_id',$transactionRefId)
                                ->where('is_active',1)
                                ->get();
                return $result;
        }
}