<?php
use App\transaction_transfer_convention as ConvModel;
// use App\Facades\EasyBook\Invoice\InvoiceAirport as invoice;

use App\Repositories\EasyBook\Transaction\TransactionConventionRepository as ConvRepos;

class ConventionTest extends TestCase{
    public function GetTransactionId(){
        return 4;
    }

    public function testGetInvoieByTransactionId(){
        $tid = $this->GetTransactionId();

        $convRepos = new ConvRepos(new ConvModel());
        $results = $convRepos->GetInvoieByTransactionId($tid);
        
        echo json_encode($results);

        $this->assertGreaterThan(0,count($results));
    }

    public function testGetPassengerByTransactionId(){
        $tid = $this->GetTransactionId();

        $convRepos = new ConvRepos(new ConvModel());
        $results = $convRepos->GetPassengerByTransactionId($tid);
        
        echo json_encode($results);

        $this->assertGreaterThan(0,count($results));
    }
}

?>