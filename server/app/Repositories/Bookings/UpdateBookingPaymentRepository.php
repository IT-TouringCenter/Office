<?php 
namespace App\Repositories\Bookings;

use Carbon\Carbon;

use App\transaction as Transaction;
use App\transaction_tour as TransactionTour;
use App\transaction_tour_history as TransactionTourHistory;
use App\transaction_tour_detail as TransactionTourDetail;
use App\transaction_tour_detail_history as TransactionTourDetailHistory;
use App\transaction_tour_reference as TransactionTourReference;
use App\guest as Guest;
use App\payment as Payment;
use App\invoice_tour as InvoiceTour;

class UpdateBookingPaymentRepository{    

	public function __construct(Transaction $Transaction, TransactionTour $TransactionTour, TransactionTourHistory $TransactionTourHistory, TransactionTourDetail $TransactionTourDetail, Guest $Guest, Payment $Payment, InvoiceTour $InvoiceTour, TransactionTourDetailHistory $TransactionTourDetailHistory, TransactionTourReference $TransactionTourReference){
		$this->Transaction = $Transaction;
		$this->TransactionTour = $TransactionTour;		
		$this->TransactionTourHistory = $TransactionTourHistory;
		$this->TransactionTourDetail = $TransactionTourDetail;
		$this->TransactionTourDetailHistory = $TransactionTourDetailHistory;
		$this->Payment = $Payment;
		$this->InvoiceTour = $InvoiceTour;
		$this->TransactionTourReference = $TransactionTourReference;
	}

	// Get transaction id
	public function GetTransactionID($upackId){
		$result = \DB::table('transaction_tour_references')
					// ->select('transaction_id')
					->where('dt_userpackage_id',$upackId)
					->get();
		return $result;
	}

	// Update transaction
	public function UpdateTransaction($transactionId){
		$data = ['is_active'=>1];
		$this->Transaction->where('id',$transactionId)->update($data);

		$result = $this->Transaction->where('id',$transactionId)->get();
		return $result;
	}

	// Update transaction tour (Get id)
	public function UpdateTransactionTour($transactionId){
		$data = ['is_active'=>1];
		$this->TransactionTour->where('transaction_id',$transactionId)->update($data);

		$result = $this->TransactionTour->where('transaction_id',$transactionId)->get();
		return $result;
	}

	// Update transaction tour history
	public function UpdateTransactionTourHistory($transactionTourId){
		$data = ['is_active'=>1];
		$result = $this->TransactionTourHistory->where('transaction_tour_id',$transactionTourId)->update($data);
		return $result;
	}

	// Update transaction tour detail (Get id)
	public function UpdateTransactionTourDetail($transactionTourId){
		$data = ['is_active'=>1];
		$this->TransactionTourDetail->where('transaction_tour_id',$transactionTourId)->update($data);

		$result = $this->TransactionTourDetail->where('transaction_tour_id',$transactionTourId)->get();
		return $result;
	}

	// Update transaction tour detail history
	public function UpdateTransactionTourDetailHistory($transactionTourDetailId){
		$data = ['is_active'=>1];
		$result = $this->TransactionTourDetailHistory->where('transaction_tour_detail_id',$transactionTourDetailId)->update($data);
		return $result;
	}

	// Update payment
	public function UpdatePayment($transactionId){
		$data = ['payment_status_id'=>2,'is_active'=>1];
		$result = $this->Payment->where('transaction_id',$transactionId)->update($data);
		return $result;
	}

	// Save invoice
	public function SaveInvoice($transactionId,$transactionTourId,$invoiceNumberData){
		$dateTimeNow = Carbon::now('Asia/Bangkok');
		$bookingNumber = [
			'transaction_id'=>$transactionId,
			'transaction_tour_id'=>$transactionTourId,
			'booking_number'=>array_get($invoiceNumberData,'bookingNumber'),
			'invoice_number'=>array_get($invoiceNumberData,'invoiceNumber'),
			'issued_by'=>'TC Website',
			'created_at'=>$dateTimeNow
		];
		return $this->InvoiceTour->insertGetId($bookingNumber);
	}

	// GetAccountID
	public function GetAccountID($transactionId){
		$result = \DB::table('transactions')
									->select('account_id')
									->where('id',$transactionId)
									->where('is_active',1)
									->get();
		return $result;
	}

	// Check payment status = paid
	public function CheckPaymentPaid($transactionId){
		$result = \DB::table('payments')
									->where('transaction_id',$transactionId)
									->where('payment_status_id',2)
									->where('is_active',1)
									->get();
		return $result;
	}
}