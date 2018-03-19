<?php
use Carbon\Carbon;
use App\payment_transaction as PaymentTr;
use App\Repositories\EasyBook\Payment\PaymentTransactionRepository as PaymentRepo;
use App\Repositories\EasyBook\Payment\PaymentTransactionRepository as PaymentRepository;
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as TransactionTransferRepository;

class PaymentTest extends TestCase{
    public function getTransactionId(){
        return 5;
    }

    // public function testGetPendingPaymentByTransactionId(){
    //     $PaymentRepo = new PaymentRepo(new PaymentTr());

    //     $transactionId= $this->getTransactionId();
    //     $results=$PaymentRepo->GetPendingPaymentByTransactionId(4);

    //     // echo json_encode($results);

    //     $status = $results->payment_transaction_status_id;
        
    //     $this->assertEquals(1,$status);
    //     $this->assertGreaterThanOrEqual(1,count($results));
    // }

    public function testGetPaymentTransaction2PayById(){
        $transactionId= $this->getTransactionId();

        $results = \PaymentFacade::GetPendingPaymentTransactionPayById($transactionId);
        echo json_encode($results);
    }

    public function testDecodeTransactionId(){
        $transactionId = 'Nzo5OTk5OTk5OTk4ODg4ODg4OA==';
        $trId =  HelperFacade::Decode($transactionId);
        echo $trId;

        $this->assertGreaterThanOrEqual(1,$trId);
    }

    public function testGetTimestamp(){
        // $date = new DateTime();
        // echo $date->getTimestamp();
        $dt = Carbon::now();
        echo $dt->timestamp;        
    }
}
?>