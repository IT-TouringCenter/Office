<?php
namespace App\Facades\Reservations\Transactions;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Reservations\TransactionRepository as TransactionRepo;

use App\transaction as Transaction;
use App\invoice_tour_offline as InvoiceTourOffline;

class TransactionClass{

	public function __construct(TransactionRepo $TransactionRepo){
		$this->TransactionRepo = $TransactionRepo;
	}

	/* ------------------------------------
	 	Logic save booking 
			1. transaction
			2. transaction_tour
			4. transaction_tour_history
			3. guest
			4. transaction_tour_detail
			5. transaction_tour_detail_history
			6. payment
			7. invoice_tour_offline
	------------------------------------ */

	// Save to DB : transaction table
	public function SaveTransactionBookingData($bookingData){
		// Set data for save
		$bookingArr = [];
		$summary = array_get($bookingData,'summary');
		$guestData = array_get($bookingData, 'guestInfo');
		$noteBy = array_get($bookingData, 'noteBy');
		$count = 1;

		$this->transaction = new Transaction;
		// Transaction
		$saveTransactionId = $this->TransactionRepo->SaveTransactionBooking($bookingData);
		// Transaction tour
		$TransactionTourId = $this->SaveTransactionTourBooking($saveTransactionId,$bookingData);
		// Payment
		$PaymentId = $this->SaveBookingPayment($saveTransactionId,$summary,$noteBy);
		// Invoice
		$Invoice = $this->SaveInvoiceTourOffline($saveTransactionId,$TransactionTourId->transactionTourId,$noteBy);

		// Guest & Tour & Tour history
		foreach($guestData as $value){
			if(array_get($value,'isAges')==1){
				$ages = 'Adult';
			}else if(array_get($value,'isAges')==2){
				$ages = 'Child';
			}else{
				$ages = 'Infant';
			}

			$this->booking = new Transaction;
			// Guest
			$guestId = $this->SaveGuestData($value,$count,$noteBy);
			// Tour detail
			$TransactionTourDetailId = $this->SaveTransactionTourDetail($TransactionTourId->transactionTourId,$guestId,$value,$ages,$noteBy);

			array_push($bookingArr, $this->booking);
			$count++;
		}
		$this->transaction->tourDetail = $bookingArr;
        return $this->transaction;
	}

	// Save to DB : Transaction tour table
	public function SaveTransactionTourBooking($tansactionId,$bookingData){
		$result = $this->TransactionRepo->SaveTransactionTourBooking($tansactionId,$bookingData);
		return $this->transaction->tour = $result;
	}

	//Save to DB : Payment table
	public function SaveBookingPayment($transactionId,$summary,$noteBy){
		$result = $this->TransactionRepo->SaveBookingPayment($transactionId,$summary,$noteBy);
		return $this->transaction->payment = $result;
	}

	// Save to DB : Guest table
	public function SaveGuestData($guestData,$count,$noteBy){
		$result = $this->TransactionRepo->SaveGuestData($guestData,$count,$noteBy);
		return $this->booking->guest = $result;
	}

	// Save to DB : Transaction tour detail table
	public function SaveTransactionTourDetail($TransactionTourId,$guestId,$guestData,$ages,$noteBy){
		$result = $this->TransactionRepo->SaveTransactionTourDetail($TransactionTourId,$guestId,$guestData,$ages,$noteBy);
		return $this->booking->tourDetail = $result;	
	}

	// Save to DB : Invoice table
	// 1. Check booking number
	public function SaveInvoiceTourOffline($transactionId,$transactionTourId,$noteBy){
		// Get booking number
		$bookingNumber = \InvoiceBookingFacade::GetLastInvoiceNumber();
		
		$this->InvoiceTourOffline = new InvoiceTourOffline;
		// Run invoice number
		$this->RunInvoiceNumber($bookingNumber);

		$result = $this->TransactionRepo->SaveInvoiceTourOffline($transactionId,$transactionTourId,$this->InvoiceTourOffline,$noteBy);
		return $this->transaction->invoiceTour = $this->InvoiceTourOffline;
	}

	// run booking and invoice number
	public function RunInvoiceNumber($bookingNumber){
		$invoice = new InvoiceTourOffline;

		// set date
		$yearNow = date('Y')+543;
		$monthNow = date('m');

		$subYearNow = substr($yearNow,2,2);
		// $subYearNow = 80;
		// $monthNow = 12;

		// Check empty
		if(empty($bookingNumber->booking_number)){
			$setBookingNumber = $subYearNow.'-'.$monthNow.'-001';
			$setInvoiceNumber = 'DT-'.$setBookingNumber;
		}else{
			// Sub booking number
			$subRunYear = substr($bookingNumber->booking_number,0,2);
			$subRunMonth = substr($bookingNumber->booking_number,3,2);
			$subRunNumber = intval(substr($bookingNumber->booking_number,6,3));

			if($subRunYear!=$subYearNow){
				// if($subRunMonth!=$monthNow){
					$setBookingNumber = $subYearNow.'-'.$monthNow.'-001';
					$setInvoiceNumber = 'DT-'.$setBookingNumber;
				// }else{
				// 	$runNumber = $subRunNumber+1;
				// 	$invRunNumber = str_pad($runNumber, 3, "0", STR_PAD_LEFT);

				// 	$setBookingNumber = $subYearNow.'-'.$monthNow.'-'.$invRunNumber;
				// 	$setInvoiceNumber = 'DT-'.$setBookingNumber;
				// }
			}else{
				if($subRunMonth!=$monthNow){
					$setBookingNumber = $subYearNow.'-'.$monthNow.'-'.'001';
					$setInvoiceNumber = 'DT-'.$setBookingNumber;
				}else{
					$runNumber = $subRunNumber+1;
					$invRunNumber = str_pad($runNumber, 3, "0", STR_PAD_LEFT);

					$setBookingNumber = $subYearNow.'-'.$monthNow.'-'.$invRunNumber;
					$setInvoiceNumber = 'DT-'.$setBookingNumber;
				}
			}
		}
		$invoice->bookingNumber = $setBookingNumber;
		$invoice->invoiceNumber = $setInvoiceNumber;

		return $this->InvoiceTourOffline = $invoice;
	}

}