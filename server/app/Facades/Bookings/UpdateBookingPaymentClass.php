<?php
namespace App\Facades\Bookings;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Repositories\Bookings\UpdateBookingPaymentRepository as UpdateBookingPaymentRepo;

use App\transaction as Transaction;
use App\invoice_tour as InvoiceTour;

class UpdateBookingPaymentClass{

	public function __construct(UpdateBookingPaymentRepo $UpdateBookingPaymentRepo){
		$this->UpdateBookingPaymentRepo = $UpdateBookingPaymentRepo;
	}

	/* ------------------------------------
	 	Logic update booking 
			1. Get transaction id
			2. Update transaction
			3. Update transaction tour
			4. Update transaction tour history
			5. Update transaction tour detail
			6. Update transaction tour detail history
			7. Update payment status
			8. Save invoice (run number)
	------------------------------------ */

	// Update is_active=1
	public function UpdateBookingPayment($data){
		$result = new Transaction;
		$checkUpdate = array_get($data,'isUpdate');
		if($checkUpdate==false){
			return 'Can not update payment.';
		}

		$upackId = array_get($data,'upackId');

		// 1. Get transaction id
		$GetTransaction = $this->UpdateBookingPaymentRepo->GetTransactionID($upackId);
		if(empty($GetTransaction)){
			return 'Transaction empty';
		}
		$TransactionId = $GetTransaction[0]->transaction_id;

		// 2. Update transaction
		$UpdateTransaction = $this->UpdateBookingPaymentRepo->UpdateTransaction($TransactionId);

		// 3. Update transaction tour
		$UpdateTransactionTourGetID = $this->UpdateBookingPaymentRepo->UpdateTransactionTour($TransactionId);

		// 4. Update transaction tour history
		$UpdateTransactionTourHistory = $this->UpdateBookingPaymentRepo->UpdateTransactionTourHistory($UpdateTransactionTourGetID[0]->id);

		// 5. Update transaction tour detail
		$UpdateTransactionTourDetailGetID = $this->UpdateBookingPaymentRepo->UpdateTransactionTourDetail($UpdateTransactionTourGetID[0]->id);

		// 6. Update transaction tour detail history
		foreach($UpdateTransactionTourDetailGetID as $value){
			$UpdateTransactionTourDetailHistory = $this->UpdateBookingPaymentRepo->UpdateTransactionTourDetailHistory($value->id);
		}		

		// 7. Save invoice (run number)
		$checkPaymentPaid = $this->UpdateBookingPaymentRepo->CheckPaymentPaid($TransactionId);
		if($checkPaymentPaid){
			$result->status = false;
			$result->message = 'Error';
			$result->data = [];

			return $result;
		}

		$SaveInvoice = $this->SaveInvoice($TransactionId,$UpdateTransactionTourGetID[0]->id);
		if($SaveInvoice){
			// 7. Update payment status
			$UpdatePaymentStatus = $this->UpdateBookingPaymentRepo->UpdatePayment($TransactionId);

			$result->status = true;
			$result->message = 'OK';
			$result->data = [];
		}else{
			$result->status = false;
			$result->message = 'Error!';
			$result->data = [];
		}

		// 9. Commission Tour
		// $affiliateCommission = $this->AffiliateCommission($TransactionId,$UpdateTransactionTourGetID[0]->id);
		// $result = $affiliateCommission;

		return $result;
	}

	//--- Save to DB : Invoice table ----------------------------------------------//
	// Check booking number
	public function SaveInvoice($transactionId,$transactionTourId){
		// Get booking number
		$bookingNumber = \InvoiceBookingFacade::GetLastInvoiceNumber();
		
		$this->InvoiceTour = new InvoiceTour;
		// Run invoice number
		$this->RunInvoiceNumber($bookingNumber);

		$result = $this->UpdateBookingPaymentRepo->SaveInvoice($transactionId,$transactionTourId,$this->InvoiceTour);
		return $this->invoiceTour = $this->InvoiceTour;
	}

	// run booking and invoice number
	public function RunInvoiceNumber($bookingNumber){
		$invoice = new InvoiceTour;

		// set date
		$yearNow = date('Y')+543;
		$monthNow = date('m');

		$subYearNow = substr($yearNow,2,2);

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
					$setBookingNumber = $subYearNow.'-'.$monthNow.'-001';
					$setInvoiceNumber = 'DT-'.$setBookingNu;
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

	//--- Commission Tour ---------------------------------------------------------//
	// Update affiliate commission
	public function AffiliateCommission($TransactionId,$TransactionTourId){
		// 1. Get transaction tour
		$bookingData = \TourCommissionFacade::GetTransactionTour($TransactionTourId);
		$tourId = $bookingData[0]->tour_id;
		
		// 2. Get account id from transactions
		$transactionData = \TourCommissionFacade::GetTransaction($TransactionId);

		if($transactionData){
			return 'true';
		}else{
			return 'false';
		}

		// Affiliate logic
		$accountId = $transactionData[0]->account_id;
		if($accountId < 1){ // none affiliate
			return 'none account';
		}else{
			// 3. Get affiliate commission
			$affiliateCommission = \TourCommissionFacade::GetAffiliateCommission($accountId);

			// 4. Get tour commission price rate
			$commissionRate = \TourCommissionFacade::GetTourCommissionPriceRate($accountId,$tourId);

			// 5. Calculate tour commission
			$calculateTourCommission = $this->CalculateTourCommission($accountId,$bookingData,$affiliateCommission,$commissionRate,$transactionData,$TransactionTourId);
			return $calculateTourCommission;
			// return $accountId;
		}
	}

	// 5. Calculate tour commission
	public function CalculateTourCommission($accountId,$bookingData,$affiliateCommission,$commissionRate,$transactionData,$transactionTourId){
		$guestPax = $bookingData[0]->pax;
		// min, max get rate
		$min = $commissionRate[0]->min_pax;
		$max = $commissionRate[0]->max_pax;

		if($min <= $guestPax && $guestPax <= $max){
			$comRate = $commissionRate[0]->price_rate / 100;
		}else{
			$comRate = 0;
		}

		// booking data
		$adultPax = $bookingData[0]->adult_pax;
		$childPax = $bookingData[0]->child_pax;
		$infantPax = $bookingData[0]->infant_pax;
		$adultPrice = $bookingData[0]->total_adult_price;
		$childPrice = $bookingData[0]->total_child_price;

		// commission (this booked)
		$comAdult = $adultPrice * $comRate;
		$comChild = $childPrice * $comRate;
		$comTotal = $comAdult + $comChild;
		$comBonus = 0;
		$comAmount = $comTotal + $comBonus;

		// calculate summary
			// 6. save affiliate commission detail
			$bookDate = \DateFormatFacade::ReverseDate($transactionData[0]->book_date);
			$travelDate = \DateFormatFacade::ReverseDate($bookingData[0]->tour_travel_date);

			$commissionDetail = new Transaction;
			$commissionDetail->bookDate = $bookDate;
			$commissionDetail->travelDate = $travelDate;
			$commissionDetail->pax = $guestPax;
			$commissionDetail->adultPax = $adultPax;
			$commissionDetail->childPax = $childPax;
			$commissionDetail->infantPax = $infantPax;
			$commissionDetail->adultPrice = $adultPrice;
			$commissionDetail->childPrice = $childPrice;
			$commissionDetail->comAdult = $comAdult;
			$commissionDetail->comChild = $comChild;
			$commissionDetail->comTotal = $comTotal;
			$commissionDetail->comBonus = 0;
			$commissionDetail->comAmount = $comAmount;
			$saveCommissionDetail = $this->SaveAffiliateCommissionDetail($commissionDetail,$accountId,$transactionTourId);

			// if($saveCommissionDetail=='true transactionData'){
			// 	// 7. save affiliate commission
			// 	$commission = new Transaction;
			// 	$commission->pax = $guestPax + $affiliateCommission[0]->pax;
			// 	$commission->adultPax = $adultPax + $affiliateCommission[0]->adult_pax;
			// 	$commission->childPax = $childPax + $affiliateCommission[0]->child_pax;
			// 	$commission->infantPax = $infantPax + $affiliateCommission[0]->infant_pax;
			// 	$commission->adultPrice = $adultPrice + $affiliateCommission[0]->adult_price;
			// 	$commission->childPrice = $childPrice + $affiliateCommission[0]->child_price;
			// 	$commission->comAdult = $comAdult + $affiliateCommission[0]->commission_adult;
			// 	$commission->comChild = $comChild + $affiliateCommission[0]->commission_child;
			// 	$commission->comTotal = $comTotal + $affiliateCommission[0]->commission_total;
			// 	$commission->comBonus = 0 + $affiliateCommission[0]->commission_bonus;
			// 	$commission->comAmount = $comAmount + $affiliateCommission[0]->commission_amount;
			// 	$saveCommission = $this->SaveAffiliateCommission($commission,$accountId);
			// }

		return $saveCommissionDetail;
	}

	// 6. save affiliate commission detail
	public function SaveAffiliateCommissionDetail($commissionDetail,$accountId,$transactionTourId){
		$data = [
			'account_id'=>$accountId,
			'transaction_tour_id'=>$transactionTourId,
			'booked_date'=>$commissionDetail->bookDate,
			'travel_date'=>$commissionDetail->travelDate,
			'pax'=>$commissionDetail->pax,
			'adult_pax'=>$commissionDetail->adultPax,
			'child_pax'=>$commissionDetail->childPax,
			'infant_pax'=>$commissionDetail->infantPax,
			'adult_price'=>$commissionDetail->adultPrice,
			'child_price'=>$commissionDetail->childPrice,
			'commission_adult'=>$commissionDetail->comAdult,
			'commission_child'=>$commissionDetail->comChild,
			'commission_total'=>$commissionDetail->comTotal,
			'commission_bonus'=>$commissionDetail->comBonus,
			'commission_amount'=>$commissionDetail->comAmount
		];
		$dataSave = \TourCommissionFacade::SaveAffiliateCommissionDetail($data,$transactionTourId);

		return $dataSave;
	}

	// 7. save affiliate commission
	public function SaveAffiliateCommission($commission,$accountId){
		$data = [
			'account_id'=>$accountId,
			'pax'=>$commission->pax,
			'adult_pax'=>$commission->adultPax,
			'child_pax'=>$commission->childPax,
			'infant_pax'=>$commission->infantPax,
			'adult_price'=>$commission->adultPrice,
			'child_price'=>$commission->childPrice,
			'commission_adult'=>$commission->comAdult,
			'commission_child'=>$commission->comChild,
			'commission_total'=>$commission->comTotal,
			'commission_bonus'=>$commission->comBonus,
			'commission_amount'=>$commission->comAmount
		];
		$dataSave = \TourCommissionFacade::SaveAffiliateCommission($data,$accountId);

		return $data;
	}
}