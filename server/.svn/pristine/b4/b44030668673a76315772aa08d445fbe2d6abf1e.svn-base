<?php
use App\transaction_transfer_airport as AirModel;
use App\Facades\EasyBook\Invoice\InvoiceAirport as invoice;

use App\Repositories\EasyBook\Transaction\TransactionAirportRepository as AirRepos;

class AirportTest extends TestCase{

    public function GetTransactionId(){
        return 1;
    }

    public function testRepGetInvoiceByTransactionId(){
        $tid = $this->GetTransactionId();

        $AirRepos = new AirRepos(new AirModel());
        $results = $AirRepos->GetInvoiceByTransactionId($tid);
        
        // echo json_encode($results);

        $this->assertGreaterThan(0,count($results));
    }

    public function testRepGetArrivalAmountByTransactionId(){

        $tid = $this->GetTransactionId();

        $AirRepos = new AirRepos(new AirModel());
        $results = $AirRepos->GetArrivalAmountByTransactionId($tid);
        
        // echo json_encode($results);

        $this->assertGreaterThan(0,count($results));

    }

     public function testRepGetDepartureAmountByTransactionId(){

        $tid = $this->GetTransactionId();

        $AirRepos = new AirRepos(new AirModel());
        $results = $AirRepos->GetDepartureAmountByTransactionId($tid);
        
        // echo json_encode($results);

        $this->assertGreaterThan(0,count($results));

    }

    public function testRepGetAmountsByTransactionId(){
        $tid = $this->GetTransactionId();

        $AirRepos = new AirRepos(new AirModel());
        $results = $AirRepos->GetAmountsByTransactionId($tid);
        
        // echo json_encode($results);

        $this->assertGreaterThan(0,count($results));
    }

    public function testRepGetPassengersByTransactionId(){
        $tid = $this->GetTransactionId();

        $AirRepos = new AirRepos(new AirModel());
        $results = $AirRepos->GetPassengersByTransactionId($tid);
        
        //echo json_encode($results);

        $this->assertGreaterThan(0,count($results));
    }

    public function testGetInvoiceByTransactionId(){
        $tid = $this->GetTransactionId();

        $results =\AiportInvoiceFacade::GetInvoiceByTransactionId($tid);
        
        echo json_encode($results);

        $this->assertGreaterThan(0,count($results));
    } 
}

?>