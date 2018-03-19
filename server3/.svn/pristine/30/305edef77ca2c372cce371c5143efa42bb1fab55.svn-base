<?php
namespace App\Facades\EasyBook\Payment;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Commons\EasyActivity as EasyActivity;
use App\Repositories\EasyBook\Payment\PaymentTransactionRepository as PaymentTransaction;

use App\payment_transaction as payment_transaction;

class PaymentTransactionClass{
	
	public function __construct(PaymentTransaction $PaymentTransaction){
		$this->PaymentTransactionRepo = $PaymentTransaction;
	}

	// save step 1
	public function Save($payment){
		if($payment->activityId == EasyActivity::ICAS10){
			$payment->expiredDate = Carbon::now('Asia/Bangkok')->addDays(7);
		}

		$this->PaymentTransactionRepo->Save($payment);		
	}

	// get payment transaction data
	public function GetPaymentTransactionData($payment_transaction_id){
		$result = $this->PaymentTransactionRepo->GetPaymentTransactionById($payment_transaction_id);
		return $result;
	}
}