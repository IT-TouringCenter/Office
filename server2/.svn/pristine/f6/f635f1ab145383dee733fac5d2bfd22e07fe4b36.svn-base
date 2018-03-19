<?php
namespace App\Facades\EasyBook\Payment;

use App\Commons\PayPalConfig;
//use App\Repositories\EasyBook\Payment\PaymentRepository as PaymentRepository;
use App\Repositories\EasyBook\Payment\PaymentTransactionRepository as PaymentRepository;
// use App\Repositories\EasyBook\Reservation\TransactionRepository as TransactionRepository;
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as TransactionTransferRepository;
// use App\Repositories\EasyBook\Payment\PaymentTransactionTransferRepository  as TransactionTransferRepository;
// use App\Repositories\EasyBook\Reservation\TransactionDetailReposity as TransactionDetailReposity;

Use Carbon\Carbon;

class PaymentClass{
	public function __construct(		
		PaymentRepository $PaymentRepository,TransactionTransferRepository $TransactionTransferRepository){
		$this->PaymentRepository = $PaymentRepository;		
		$this->TransactionTransferRepository = $TransactionTransferRepository;
	}

	public function SavePaymentTranasction($transactionId,$paymentStatusId,$paymentChanelId,$amount){
		
	}


	public function CancelPaymentByTransactionId($transaction_id){
		$this->PaymentRepository->CancelPaymentByTransactionId($transaction_id);
	}

	public function ConfirmPaymentByTransactionId($request){
		\DB::beginTransaction();
		try{
			
			$transactionId = \HelperFacade::Decode($request->cm);
			$result= $this->PaymentRepository->ApprovedPayPayPalByTransactionId($transactionId);
			//$this->TransactionTransferRepository->ConfirmPaymentByTransactionId($transactionId);
			
			if($result == false){
				\DB::rollBack();
				return false;
			}
			
			\EmailFacade::SavePaidPaymentEmail($transactionId);

			\DB::commit();

			return true;
		}catch(Exception $ex){
			\DB::rollBack();
			throw $ex;			
		}		
	}

	public function GetPaymentTransactionById($transactionId){
		$result = $this->GetPaymentTransaction2PayById($transactionId);		
		return array_set($result,'data.transactionId',\HelperFacade::Encode($transactionId));		
	}

	public function GetTransaction2PayWithPaypal($transactionId){		
		$id=\HelperFacade::Decode($transactionId);
		return $this->GetPendingPaymentTransactionPayById($id);
	}

	public function Verify($verifyBy){
		$payments = $this->PaymentRepository->GetPaymentTransactions();

		if(count($payments) || $payments==null){return "No expire payment transaction.";}

		foreach ($payments as $payment) {			
			if($payment->expired_date < Carbon::now('Asia/Bangkok')){
				$id=$payment->id;
				$status=1;//0: Normal, 1: Expired
				$isActive =0;
				$this->PaymentRepository->VeriryPaymentStatusById($id,$status,$verifyBy,$isActive);
			}
		}
	}
	
	public function GetPendingPaymentTransactionPayById($transactionId){
		$paymentTransaction = $this->PaymentRepository->GetPendingPaymentByTransactionId($transactionId);

		if($paymentTransaction==null){
			return ["status"=>false,"data"=>"The transaction unvariable"];
		}
		if($paymentTransaction->transaction_status_id==2){
			return ["status"=>false,"data"=>"The transaction unvariable"];
		}

		$primaryContact = 'dummyPaypal@dummy.com';
		$transferTranactions = $this->TransactionTransferRepository->GetDataByTransactionId($transactionId);
		foreach ($transferTranactions as $transfer) {
			$person = $transfer->GetPassengers;
			if($person->parent_id == 0){
				$primaryContact =  $person->email;
				break;
			}
		}

		//return $primaryContact;
		$paypal = \HelperFacade::GetPaypalConfiguration();
						
		$results=[		
			"email"=>$primaryContact,
			"transactionId"=>\HelperFacade::Encode($transactionId),
			"amount"=>$paymentTransaction->amount,

			"itemName"=>'ICAS10:Transfer',

			"paypalCgi"=>array_get($paypal,"paypalCgi"),
			"paypalId"=>array_get($paypal,"paypalId"),
			"completeUrl"=>array_get($paypal,"completeUrl"),
			"timeoutUrl"=>array_get($paypal,"timeoutUrl"),
			"cancelUrl"=>array_get($paypal,"cancelUrl"),
			"notifyUrl"=>array_get($paypal,"notifyUrl")
		];

		return ["status"=>true,"data"=>$results];
	}

	// check ExpiredPayment
	public function ExpiredPayment() {
	 	// return "Mission Complete !!!";

	 	$getRes = $this->PaymentRepository->ExpiredPayment();
	 	return $getRes;
	} 
}