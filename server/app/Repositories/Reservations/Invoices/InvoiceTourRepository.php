<?php 
namespace App\Repositories\Reservations\Invoices;

class InvoiceTourRepository{    

	public function __construct(){
		
	}

	// Get invoice tour
	public function GetLastInvoiceNumber(){
                $result = \DB::table('invoice_tours')
                                ->select('booking_number')
                                ->where('is_active',1)
                                ->orderBy('id','desc')
                                ->first();
                return $result;
	}

        // Get invoice tour by transaction id
        public function GetInvoiceTourByTransactionId($transactionId){
                $result = \DB::table('invoice_tours')
                                ->where('transaction_id',$transactionId)
                                ->where('is_active',1)
                                ->get();
                return $result;
        }

        // Get reference invoice tour by invoice id
        public function GetReferenceInvoiceTourByTransactionId($transactionRefId){
                $result = \DB::table('invoice_tours')
                                ->where('transaction_id',$transactionRefId)
                                ->where('is_active',1)
                                ->get();
                return $result;
        }
}