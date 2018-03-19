<?php

use App\transaction_transfer_airport as Airport;
use App\transaction_transfer as TransactionTransfer;
use App\transaction_transfer_convention as Convention;
use App\Repositories\EasyBook\Transaction\TransactionTransferRepository as transferRepo;

class TransactionTransferTest extends TestCase{
    public function getTransactionId(){
        return 2;
    }

    public function testGetDataByTransactionId(){
        $transferRepo = new transferRepo(new TransactionTransfer(),new Convention(), new Airport());

        $transactionId = $this->getTransactionId();
        $result = $transferRepo->GetDataByTransactionId($transactionId);

        //echo json_encode($result);        

        //$this->assertCount(1,$result);
        $this->assertGreaterThanOrEqual(1,count($result));

    }

    public function testGetPrimaryHotelByTransactionId(){
        $transactionId = $this->getTransactionId();

        $transferRepo = new transferRepo(new TransactionTransfer(),new Convention(), new Airport());        
        $result = $transferRepo->GetPrimaryHotelByTransactionId($transactionId);
        
        // echo json_encode($result);

        $this->assertGreaterThanOrEqual(1,count($result));
    }

    public function testGetConventionTransferByTransactionId(){
        $transactionId=$this->getTransactionId();

        $transferRepo = new transferRepo(new TransactionTransfer(),new Convention(), new Airport());     
        $result= $transferRepo->GetConventionInvoiceByTransactionId($transactionId);
        
        //echo json_encode($result);

        $this->assertGreaterThanOrEqual(1,count($result));
    }

    public function testGetPassengersConventionInvoiceByTransactionId(){
        $transactionId=$this->getTransactionId();

        $transferRepo = new transferRepo(new TransactionTransfer(),new Convention(), new Airport());     
        $result= $transferRepo->GetPassengersConventionInvoiceByTransactionId($transactionId);
        
        echo json_encode($result);

        $this->assertGreaterThanOrEqual(1,count($result));
    }

    public function testGetAirportInvoiceByTransactionId(){
        $transactionId=$this->getTransactionId();

        $transferRepo = new transferRepo(new TransactionTransfer(),new Convention(), new Airport());     
        $result= $transferRepo->GetAirportInvoiceByTransactionId($transactionId);
        
        echo json_encode($result);

        $this->assertGreaterThanOrEqual(1,count($result));
    }

    public function testGetPassengersAirportInvoiceByTransactionId(){
        $transactionId=$this->getTransactionId();

        $transferRepo = new transferRepo(new TransactionTransfer(),new Convention(), new Airport());     
        $result= $transferRepo->GetPassengersAirportInvoiceByTransactionId($transactionId);
        
        // echo json_encode($result);

        $this->assertGreaterThanOrEqual(1,count($result));
    }
    
}
?>