<?php 
namespace App\Repositories\EasyBook\Payment;

// use App\Commons\UpdatedBy;
use Carbon\Carbon;
use App\Commons\UpdatedBy as UpdatedBy;
use App\payment_transaction as PaymentTransaction;
use App\Commons\Payment\PaymentTransactionStatus as PaymentStatus;

class PaymentTransactionRepository{
    public function __construct(PaymentTransaction $PaymentTransaction){
        $this->PaymentTransactionModel = $PaymentTransaction;        
    }

    public function Save($payment){        
        $payment = [
            "transaction_id"=>$payment->transactionId,
            "payment_transaction_status_id"=>$payment->paymentStatus,
            "paymant_transaction_channel_id"=>$payment->paymentChannel,
            "activity_id"=>$payment->activityId,
            "amount"=>$payment->amount,
            "expired_date"=>$payment->expiredDate,
            "payment_date"=>null,
            "is_expired"=>$payment->isExpired,
            "created_by"=>"System",
            "created_at"=>Carbon::now('Asia/Bangkok')
        ];

        return $this->PaymentTransactionModel->insertGetId($payment);        
    }

    public function GetPaymentById($paymentTransactionId){
        return $this->PaymentTransactionModel
                    ->where('id', $paymentTransactionId)
                    ->where('is_active', 1)
                    ->where('is_expired', 0)
                    // ->where('expired_date', '<' ,Carbon::now('Asia/Bangkok'))
                    //->get();
                    ->first();
    }

    public function GetPendingPaymentByTransactionId($transactionId){
        return $this->PaymentTransactionModel
                    ->where('transaction_id',$transactionId)
                    ->where('is_active',1)
                    ->where('payment_transaction_status_id',PaymentStatus::Pending)
                    ->where('is_expired', 0)
                    ->first();
    }

    public function ApprovedPayPayPalByTransactionId($transactionId) {
        $transaction = $this->GetPaymentByTransactionId($transactionId);
        if($transaction == null) {
            return false;
        }

        $payment = $this->GetPaymentById($transaction->id);
        
        if($payment != null){
            $payment->payment_transaction_status_id=PaymentStatus::Approved;
            $payment->payment_date = Carbon::now('Asia/Bangkok');
            $payment->updated_by=UpdatedBy::PAYPAL;
            $payment->updated_at=Carbon::now('Asia/Bangkok');
        
            $payment->Save();
        }

        return true;
    }

    public function GetPaymentByTransactionId($transactionId){
        return $this->PaymentTransactionModel
                    ->where('transaction_id',$transactionId)
                    ->where('is_active',1)
                    ->where('is_expired', 0)
                    ->first();
    }

    // check ExpiredPayment

    public function ExpiredPayment() {
        return \DB::table('payment_transactions')
                ->where('expired_date','<',Carbon::now('Asia/Bangkok'))
                ->update(array('is_expired'=>1, 'is_active'=>0));
    }
}