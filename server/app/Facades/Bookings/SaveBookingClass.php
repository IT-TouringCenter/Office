<?php
namespace App\Facades\Bookings;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Bookings\SaveBookingRepository as SaveBookingRepo;

use App\transaction as Transaction;
use App\invoice_tour as InvoiceTour;

class SaveBookingClass{

	public function __construct(SaveBookingRepo $SaveBookingRepo){
		$this->SaveBookingRepo = $SaveBookingRepo;
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
			7. account
	------------------------------------ */

	// Save to DB : transaction table
	public function SaveBooking($bookingData){
		// Set data for save
		$bookingArr = [];
		$summary = array_get($bookingData,'summary');
		$guestData = array_get($bookingData, 'guestInfo');
		$noteBy = array_get($bookingData, 'noteBy');
		$invoiceRef = array_get($bookingData, 'invoiceRef');
		$account = array_get($bookingData, 'account');
		$count = 1;

		$this->transaction = new Transaction;
		// Account
		$GetAccountId = \AccountFacade::GetAffiliateAccountIDByToken(array_get($account,'affId'));
		$this->transaction->account = $GetAccountId;
		// Transaction
		$saveTransactionId = $this->SaveBookingRepo->SaveTransactionBooking($bookingData,$GetAccountId);
		// Transaction tour
		$TransactionTourId = $this->SaveTransactionTourBooking($saveTransactionId,$bookingData);
		// Transaction tour reference
		$saveTransactionTourReference = $this->SaveBookingRepo->SaveTransactionTourReference($saveTransactionId, array_get($bookingData,'upackId'));
		// Payment
		$PaymentId = $this->SaveBookingPayment($saveTransactionId,$summary,$noteBy);

		$agesArr = [];
		// Guest & Tour & Tour history
		foreach($guestData as $value){
			if(array_get($value,'isAges')==1){
				$ages = 'Adult';
			}else if(array_get($value,'isAges')==2){
				$ages = 'Child';
			}else{
				$ages = 'Infant';
			}
			array_push($agesArr,array_get($guestData[$count-1],'isAges'));
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
		// return $guestData;
	}

	// Save to DB : Transaction tour table
	public function SaveTransactionTourBooking($tansactionId,$bookingData){
		$result = $this->SaveBookingRepo->SaveTransactionTourBooking($tansactionId,$bookingData);
		return $this->transaction->tour = $result;
	}

	//Save to DB : Payment table
	public function SaveBookingPayment($transactionId,$summary,$noteBy){
		$result = $this->SaveBookingRepo->SaveBookingPayment($transactionId,$summary,$noteBy);
		return $this->transaction->payment = $result;
	}

	// Save to DB : Guest table
	public function SaveGuestData($guestData,$count,$noteBy){
		$result = $this->SaveBookingRepo->SaveGuestData($guestData,$count,$noteBy);
		return $this->booking->guest = $result;
	}

	// Save to DB : Transaction tour detail table
	public function SaveTransactionTourDetail($TransactionTourId,$guestId,$guestData,$ages,$noteBy){
		$result = $this->SaveBookingRepo->SaveTransactionTourDetail($TransactionTourId,$guestId,$guestData,$ages,$noteBy);
		return $this->booking->tourDetail = $result;	
	}

	// Save to DB : Account
	public function SaveAccount(){
		
	}

}