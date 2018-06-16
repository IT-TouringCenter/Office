<?php
namespace App\Facades\Reservations\Transactions;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

// import repo
use App\Repositories\Reservations\TransactionEditRepository as TransactionEditRepo;

// import model
use App\transaction as Transaction;

class EditReservationClass{

	public function __construct(TransactionEditRepo $TransactionEditRepo){
		$this->TransactionEditRepo = $TransactionEditRepo;
	}

	/* ------------------------------------
	 	Logic update booking 
			1. transaction
			2. transaction_tour
			4. transaction_tour_history
			3. guest
			4. transaction_tour_detail
			5. transaction_tour_detail_history
	------------------------------------ */

	// update to DB : transaction table
	public function EditReservation($bookingData){
		// Set data for Edit
		$bookingArr = [];
		$summary = array_get($bookingData,'summary');
		$guestData = array_get($bookingData, 'guestInfo');
		$noteBy = array_get($bookingData, 'noteBy');
		$invoiceRef = array_get($bookingData, 'invoiceRef');
		$count = 1;
        $transactionId = array_get($bookingData, 'transId');

		$this->transaction = new Transaction;
		// Transaction
		$EditTransactionId = $this->TransactionEditRepo->EditTransactionBooking($transactionId,$bookingData);

		// Transaction tour
		$TransactionTourId = $this->EditTransactionTourBooking($transactionId,$bookingData);

		// Transaction tour detail , tour detail history (Update is active = 0)
		$update = $this->TransactionEditRepo->UpdateTransactionTourDetail($TransactionTourId->transactionTourId);

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
			$guestId = $this->EditGuestData($value,$count,$noteBy);
			// Tour detail
			$TransactionTourDetailId = $this->EditTransactionTourDetail($TransactionTourId->transactionTourId,$guestId,$value,$ages,$noteBy);

			array_push($bookingArr, $this->booking);
			$count++;
		}
		$this->transaction->tourDetail = $bookingArr;
        return $this->transaction;
	}

	// Edit to DB : Transaction tour table
	public function EditTransactionTourBooking($transactionId,$bookingData){
		$result = $this->TransactionEditRepo->EditTransactionTourBooking($transactionId,$bookingData);
		return $this->transaction->tour = $result;
	}

	// Edit to DB : Guest table
	public function EditGuestData($guestData,$count,$noteBy){
		$result = $this->TransactionEditRepo->EditGuestData($guestData,$count,$noteBy);
		return $this->booking->guest = $result;
	}

	// Edit to DB : Transaction tour detail table
	public function EditTransactionTourDetail($TransactionTourId,$guestId,$guestData,$ages,$noteBy){
        // update is active = 0
		// $update = $this->TransactionEditRepo->UpdateTransactionTourDetail($TransactionTourId);
		$result = $this->TransactionEditRepo->EditTransactionTourDetail($TransactionTourId,$guestId,$guestData,$ages,$noteBy);
		return $this->booking->tourDetail = $result;
		// if($update){
        //     // new insert
		//     $result = $this->TransactionEditRepo->EditTransactionTourDetail($TransactionTourId,$guestId,$guestData,$ages,$noteBy);
		//     return $this->booking->tourDetail = $result;
        // }else{
        //     return $this->booking->tourDetail = '';
        // }
	}
}