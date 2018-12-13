<?php
namespace App\Facades\Reservations\Transactions;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Reservations\TransactionRepository as TransactionRepo;
use App\Repositories\Reservations\Accounts\AccountRepository as AccountRepo;

use App\transaction as Transaction;
use App\invoice_tour as InvoiceTour;

class TransactionClass{

	public function __construct(TransactionRepo $TransactionRepo, AccountRepo $AccountRepo){
		$this->TransactionRepo = $TransactionRepo;
		$this->AccountRepo = $AccountRepo;
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
			7. invoice_tour
	------------------------------------ */

	// Save to DB : transaction table
	public function SaveTransactionBookingData($bookingData){
		// Set data for save
		$bookingArr = [];
		$summary = array_get($bookingData,'summary');
		$guestData = array_get($bookingData, 'guestInfo');
		$noteBy = array_get($bookingData, 'noteBy');
		$invoiceRef = array_get($bookingData, 'invoiceRef');
		$count = 1;

		// Check account
		$checkAccount = $this->CheckAccountEmpty(array_get($bookingData,'accountInfo'));
		$accountId = array_get($checkAccount,'id');

		$this->transaction = new Transaction;
		// Transaction
		$saveTransactionId = $this->TransactionRepo->SaveTransactionBooking($bookingData,$accountId);
		// Transaction tour
		$TransactionTourId = $this->SaveTransactionTourBooking($saveTransactionId,$bookingData);
		// Payment
		$PaymentId = $this->SaveBookingPayment($saveTransactionId,$summary,$noteBy);
		// Invoice
		$Invoice = $this->SaveInvoiceTour($saveTransactionId,$TransactionTourId->transactionTourId,$noteBy,$invoiceRef,array_get($bookingData,'isRevised'));

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

	// Check account empty
	public function CheckAccountEmpty($accountInfo){
		$token = array_get($accountInfo,'token');
		// return $token;
		$getAccount = $this->AccountRepo->GetAccountByToken($token);
		// return $getAccount;
		$account = new Transaction;
		if($getAccount){
			$account->id = $getAccount[0]->id;
			$account->token = $getAccount[0]->token;
		}else{
			$account->id = 0;
			$account->token = '';
		}
		return $account;
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
	public function SaveInvoiceTour($transactionId,$transactionTourId,$noteBy,$invoiceRef,$isRevised){
		// Get booking number
		$bookingNumber = \InvoiceBookingFacade::GetLastInvoiceNumber();

		$this->InvoiceTour = new InvoiceTour;
		// Run invoice number
		$this->RunInvoiceNumber($bookingNumber);

		$result = $this->TransactionRepo->SaveInvoiceTour($transactionId,$transactionTourId,$this->InvoiceTour,$noteBy,$invoiceRef,$isRevised);
		return $this->transaction->invoiceTour = $this->InvoiceTour;
	}

	// run booking and invoice number
	public function RunInvoiceNumber($bookingNumber){
		$invoice = new InvoiceTour;

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

		return $this->InvoiceTour = $invoice;
	}

}