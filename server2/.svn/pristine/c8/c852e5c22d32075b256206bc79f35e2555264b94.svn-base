<?php
use App\transaction as TransactionModel;
use App\Repositories\EasyBook\Transaction\TransactionRepository as TransactionRepository;

class TSTest extends TestCase{

    public function testGetDataByTransactionId(){        
        $transactionModel = new TransactionModel();
        $transactionRepository  =new TransactionRepository($transactionModel);

        $transactionId = 1;
        $result = $transactionRepository->GetDataByTransactionId($transactionId);
        //var_dump($result->toArray());
        //print_r($result->toArray());
        $this->assertEquals(1,$result->activity_id);
    }
}
?>