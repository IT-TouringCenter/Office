<?php 
namespace App\Repositories\EasyBook\Payment;

use App\Commons\UpdatedBy;
//use App\payment_transaction_transfer as PaymentTransactinTransfer;
use App\payment_transaction as PaymentTranasction;
use App\Commons\TransactionStatus;
use Carbon\Carbon;

class PaymentTransactionTransferRepository{    
    public function __construct(PaymentTranasction $PaymentTranasction){
        //$this->PaymentTransactinTransfer=$PaymentTransactinTransfer;
        $this->PaymentTransactionModel = $PaymentTranasction;
    }

    public function CancelPaymentByTransactionId($transaction_id){
        $payObj= $this->GetDataByTransactionId($transaction_id);        
        
        if($payObj == null){return "The transaction is not aviable.";}

        $payObj->transaction_status_id = TransactionStatus.CANCELLED;
        $payObj->updated_by=UpdatedBy::PAYPAL;
        $payObj->updated_at=Carbon::now('Asia/Bangkok');
        $payObj->save();
    }

    public function ConfirmPaymentByTransactionId($transactionId){
        
        $payObj = $this->GetDataByTransactionId($transactionId);        
       
        if($payObj == null){return false;}
        if($payObj->transaction_status_id == TransactionStatus::APPROVED){return false;}

        $payObj->transaction_status_id = TransactionStatus::APPROVED;
        $payObj->updated_by=UpdatedBy::PAYPAL;
        $payObj->updated_at=Carbon::now('Asia/Bangkok');
        
        return $payObj->save();
    }

    public function Save($data){
        // $periods = env("PAYMENT_PERIOD_EXPIRE");
        // if($periods == "" || $periods==null){
		// 	$day=0;
		// 	$month=1;
		// 	$year=0;
		// } else{
		// 	$paymentPeriods= explode(":",$periods);
		// 	$day = $paymentPeriods[0];
		// 	$month = $paymentPeriods[1];
		// 	$year = $paymentPeriods[2];
		// }

        // $payment=[
		// 	'transaction_transfer_id'=>$data->transactionTransferId,
		// 	'transaction_status_id'=>$data->transactionStatusId,// for test
		// 	'transaction_source_id' =>$data->transactionSourceId,
		// 	'paymant_transaction_method_id' =>$data->paymentTransactionMethodId,
		// 	'payment_datetime' =>Carbon::now('Asia/Bangkok'),
		// 	'amount' =>$data->amount,

        //     'expired_date'=>Carbon::now('Asia/Bangkok')
		// 			->addDays($day)
		// 			->addMonths($month)
		// 			->addYear($year),

		// 	'is_active' =>true,
		// 	'created_by' =>'System',
		// 	'created_at'=>Carbon::now('Asia/Bangkok')
		// ];
		// return $this->PaymentTransactinTransfer->insert($payment);
    }

    public function GetPaymentTransaction2PayById($transactionId){
        return $this->GetDataByTransactionId($transactionId);
            // ->where('is_active','=',1)
            // ->where('transaction_id','=',$transactionId)
            // ->get(['id','transaction_id','transaction_status_id','amount']);
    }

    public function GetDataByTransactionId($transactionId){
        // return $this->PaymentTransactinTransfer
        //     ->where('is_active','=',1)
        //     ->where('transaction_transfer_id','=',$transactionId)
        //     ->first();
    }

    public function GetPaymentTransactions(){
        // return $this->PaymentTransactinTransfer
        //             ->where('is_active','=',1)
        //             ->where('is_expired','=',0)
        //             ->take(50)
        //             ->get(['id','expired_date']);
    }

    public function VeriryPaymentStatusById($id,$status,$verifyBy,$isActive){
        // $payment= $this->PaymentTransactinTransfer
        //     ->where('id','=',$id)
        //     ->first();
        
        // if($payment ==null){return;}

        // $payment->is_active= $isActive;
        
        // $payment->is_expired = $status;        
        // $payment->updated_by = $verifyBy;
        // $payment->updated_at = Carbon::now('Asia/Bangkok');

        // $payment->save();
    }
}