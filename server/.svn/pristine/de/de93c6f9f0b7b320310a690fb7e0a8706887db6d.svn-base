<?php

use App\transaction_transfer_airport as Airport;
use App\transaction_transfer as TransactionTransfer;
use App\transaction_transfer_convention as Convention;
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as transferRepo;

class TransactionTransferTest extends TestCase{    
    public function testGetDataByTransactionId(){
        $transactionTransferRepo = new TransactionTransfer();
        $conventionModel = new Convention();
        $airportModel = new Airport();

        $transferRepo = new transferRepo( $transactionTransferRepo,$conventionModel, $airportModel);

        $transactionId = 1;
        $result = $transferRepo->GetDataByTransactionId($transactionId);
        print_r($result[0]->toArray());
        
        $this->assertCount(1,$result);        

    }
}
?>